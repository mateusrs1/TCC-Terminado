<?php

class Pedido {

    // Método para fazer um pedido
    public static function fazerPedido() {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();
            
            // Obtemos o carrinho do usuário atual
            $carrinho = Carrinho::obterCarrinho();
            if (empty($carrinho)) {
                return false; // Retorna falso se o carrinho estiver vazio
            }

            // Calcula o valor total do pedido
            $valorTotal = 0;
            foreach ($carrinho as $item) {
                $valorTotal += $item['preco'] * $item['quantidade'];
            }
            
            // Criamos o pedido na tabela `tb_pedidos`
            $sql = $pdo->prepare("INSERT INTO `tb_pedidos` (`usuario_id`, `status`, `data_criacao`, `valor_total`) VALUES (?, 'PENDENTE', NOW(), ?)");
            $sql->execute(array($_SESSION['user_id'], $valorTotal));
            
            $pedido_id = $pdo->lastInsertId(); // Obtém o ID do pedido recém-criado
            
            // Inserimos os itens do carrinho no pedido
            foreach ($carrinho as $item) {
                $sql = $pdo->prepare("INSERT INTO `tb_pedido_itens` (`pedido_id`, `produto_id`, `quantidade`, `preco`) VALUES (?, ?, ?, ?)");
                $sql->execute(array($pedido_id, $item['produto_id'], $item['quantidade'], $item['preco']));
            }

            // Limpa o carrinho após o pedido ser feito
            $sql = $pdo->prepare("DELETE FROM `tb_carrinho` WHERE `usuario_id` = ?");
            $sql->execute(array($_SESSION['user_id']));
            
            // Adiciona XP ao usuário com base em 30% do valor total do pedido
            $xp = round($valorTotal * 0.3);
            Usuario::adicionarXP($_SESSION['user_id'], $xp);
            
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao fazer pedido: " . $e->getMessage());
            return false;
        }
    }

    // Método para obter pedidos do usuário atual
    public static function obterPedidosUsuario() {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();
    
            // Ordenar por status e depois por data de criação
            $sql = $pdo->prepare("SELECT p.*, pi.produto_id, pi.quantidade, pi.preco, m.nome 
                                  FROM `tb_pedidos` p 
                                  JOIN `tb_pedido_itens` pi ON p.id = pi.pedido_id 
                                  JOIN `tb_produtos` m ON pi.produto_id = m.id 
                                  WHERE p.`usuario_id` = ? 
                                  ORDER BY p.`status` ASC, p.`data_criacao` DESC");
            $sql->execute(array($_SESSION['user_id']));
            
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter pedidos do usuário: " . $e->getMessage());
            return [];
        }
    }
    

    // Método para obter todos os pedidos (para ADMIN e COZINHEIRO)
    public static function obterTodosPedidos($status = null) {
        self::verificarAdminCozinheiro();
    
        try {
            $pdo = MySql::conectar();
    
            $query = "SELECT p.*, pi.produto_id, pi.quantidade, pi.preco, m.nome, u.nome AS usuario_nome 
                      FROM `tb_pedidos` p 
                      JOIN `tb_pedido_itens` pi ON p.id = pi.pedido_id 
                      JOIN `tb_produtos` m ON pi.produto_id = m.id 
                      JOIN `tb_user` u ON p.usuario_id = u.id";
            
            if ($status) {
                $query .= " WHERE p.`status` = ?";
            }
            
            $query .= " ORDER BY p.`data_criacao` DESC";
    
            $sql = $pdo->prepare($query);
            $status ? $sql->execute([$status]) : $sql->execute();
            
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter todos os pedidos: " . $e->getMessage());
            return [];
        }
    }
    
    

    // Método para obter itens dos pedidos
    public static function obterItensPedidos() {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();
            
            // Obtém todos os itens dos pedidos
            $sql = $pdo->prepare("SELECT pi.pedido_id, m.nome, pi.quantidade FROM `tb_pedido_itens` pi JOIN `tb_produtos` m ON pi.produto_id = m.id");
            $sql->execute();
            
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter itens dos pedidos: " . $e->getMessage());
            return [];
        }
    }

    // Método para atualizar o status de um pedido (para ADMIN e COZINHEIRO)
    public static function atualizarStatusPedido($pedido_id, $novo_status) {
        self::verificarAdminCozinheiro();
        
        try {
            $pdo = MySql::conectar();

            $sql = $pdo->prepare("UPDATE `tb_pedidos` SET `status` = ? WHERE `id` = ?");
            $sql->execute(array($novo_status, $pedido_id));
        } catch (PDOException $e) {
            error_log("Erro ao atualizar o status do pedido: " . $e->getMessage());
        }
    }

    // Método para verificar se o usuário está logado
    private static function verificarUsuario() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit();
        }
    }

    // Método para verificar se o usuário é ADMIN ou COZINHEIRO
    private static function verificarAdminCozinheiro() {
        if (!in_array($_SESSION['cargo'], ['ADMIN', 'COZINHEIRO'])) {
            header('Location: login');
            exit();
        }
    }

    public static function excluirPedido($pedido_id) {
        self::verificarAdminCozinheiro();
        
        try {
            $pdo = MySql::conectar();

            // Remove os itens do pedido
            $sql = $pdo->prepare("DELETE FROM `tb_pedido_itens` WHERE `pedido_id` = ?");
            $sql->execute(array($pedido_id));
            
            // Remove o pedido
            $sql = $pdo->prepare("DELETE FROM `tb_pedidos` WHERE `id` = ?");
            $sql->execute(array($pedido_id));
        } catch (PDOException $e) {
            error_log("Erro ao excluir o pedido: " . $e->getMessage());
        }
    }
}
