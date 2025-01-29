<?php

class Carrinho {

    public static function adicionarAoCarrinho($produto_id) {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();
    
            $sql = $pdo->prepare("SELECT quantidade FROM `tb_carrinho` WHERE `produto_id` = ? AND `usuario_id` = ?");
            $sql->execute(array($produto_id, $_SESSION['user_id']));
            
            if ($sql->rowCount() > 0) {
                $sql = $pdo->prepare("UPDATE `tb_carrinho` SET `quantidade` = `quantidade` + 1 WHERE `produto_id` = ? AND `usuario_id` = ?");
                $sql->execute(array($produto_id, $_SESSION['user_id']));
            } else {
                $sql = $pdo->prepare("INSERT INTO `tb_carrinho` (`usuario_id`, `produto_id`, `quantidade`) VALUES (?, ?, 1)");
                $sql->execute(array($_SESSION['user_id'], $produto_id));
            }
        } catch (PDOException $e) {
            error_log("Erro ao adicionar item ao carrinho: " . $e->getMessage());
        }
    }
    

    public static function removerDoCarrinho($produto_id) {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();

            $sql = $pdo->prepare("SELECT * FROM `tb_carrinho` WHERE `produto_id` = ? AND `usuario_id` = ?");
            $sql->execute(array($produto_id, $_SESSION['user_id']));
            
            if ($sql->rowCount() > 0) {
                $sql = $pdo->prepare("UPDATE `tb_carrinho` SET `quantidade` = `quantidade` - 1 WHERE `produto_id` = ? AND `usuario_id` = ?");
                $sql->execute(array($produto_id, $_SESSION['user_id']));

                $sql = $pdo->prepare("DELETE FROM `tb_carrinho` WHERE `produto_id` = ? AND `usuario_id` = ? AND `quantidade` <= 0");
                $sql->execute(array($produto_id, $_SESSION['user_id']));
            }
        } catch (PDOException $e) {
            error_log("Erro ao remover item do carrinho: " . $e->getMessage());
        }
    }

    public static function obterCarrinho() {
        self::verificarUsuario();
        
        try {
            $pdo = MySql::conectar();

            $sql = $pdo->prepare("SELECT c.*, m.nome, m.preco FROM `tb_carrinho` c JOIN `tb_produtos` m ON c.produto_id = m.id WHERE c.`usuario_id` = ?");
            $sql->execute(array($_SESSION['user_id']));
            
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter o carrinho: " . $e->getMessage());
            return [];
        }
    }

    private static function verificarUsuario() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
            exit();
        }
    }
}