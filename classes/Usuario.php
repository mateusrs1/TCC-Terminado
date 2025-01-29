<?php

class Usuario {

    public static function atualizarUsuario($nome, $senha, $imagem, $endereco) {
        try {
            $pdo = MySql::conectar();

            // Verifica se uma nova senha foi fornecida
            if (!empty($senha)) {
                // Atualiza com nova senha
                $sql = $pdo->prepare("UPDATE tb_user SET nome = ?, senha = ?, endereco = ?, img = ? WHERE email = ?");
                $sql->execute([$nome, $senha, $imagem, $endereco, $_SESSION['email']]);
            } else {
                // Atualiza sem alterar a senha
                $sql = $pdo->prepare("UPDATE tb_user SET nome = ?, img = ? WHERE email = ?");
                $sql->execute([$nome, $imagem, $endereco, $_SESSION['email']]);
            }

            return true;
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function userExists($email) {
        try {
            $sql = MySql::conectar()->prepare("SELECT id FROM tb_user WHERE email = ?");
            $sql->execute([$email]);
            return $sql->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar existência do usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function loginUsuario($email, $senha) {
        try {
            $sql = MySql::conectar()->prepare("SELECT * FROM tb_user WHERE email = ?");
            $sql->execute([$email]);
            
            if ($sql->rowCount() == 1) {
                $info = $sql->fetch();
                if ($senha === $info['senha']) {
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['img'] = $info['img'];
                    $_SESSION['nivel'] = $info['nivel'];
                    $_SESSION['xp'] = $info['xp'];
                    $_SESSION['user_id'] = $info['id'];
                    $_SESSION['endereco'] = $info['endereco'];
                    return true;
                } else {
                    error_log("Senha incorreta para o email: " . $email);
                    return false;
                }
            } else {
                error_log("Email não encontrado: " . $email);
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erro ao realizar login: " . $e->getMessage());
            return false;
        }
    }

    public static function cadastrarUsuario($nome, $senha, $email, $endereco) {
        try {
            if (self::userExists($email)) {
                return false;
            }

            $imagem = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Placeholder_no_text.svg/1024px-Placeholder_no_text.svg.png';
            $nivel = 1;
            $xp = 0;
            $cargo = "USUARIO";
           

            $sql = MySql::conectar()->prepare("INSERT INTO tb_user (nome, senha, img, email, cargo, nivel, xp, endereco) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
            return $sql->execute([$nome, $senha, $imagem, $email, $cargo, $nivel, $xp, $endereco]);
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function adicionarXP($user_id, $xp) {
        try {
            $pdo = MySql::conectar();

            $sql = $pdo->prepare("SELECT xp, nivel FROM tb_user WHERE id = ?");
            $sql->execute([$user_id]);
            $info = $sql->fetch();

            $novoXP = $info['xp'] + $xp;
            $novoNivel = self::calcularNivel($novoXP);

            $sql = $pdo->prepare("UPDATE tb_user SET xp = ?, nivel = ? WHERE id = ?");
            $sql->execute([$novoXP, $novoNivel, $user_id]);

            $_SESSION['xp'] = $novoXP;
            $_SESSION['nivel'] = $novoNivel;

        } catch (PDOException $e) {
            error_log("Erro ao adicionar XP: " . $e->getMessage());
        }
    }

    private static function calcularNivel($xp) {
        return floor($xp / 100) + 1;
    }

    private static function calcularProximoNivel($xpAtual) {
        $nivelAtual = self::calcularNivel($xpAtual);
        $xpParaProximoNivel = ($nivelAtual * 100) - $xpAtual;
        return $xpParaProximoNivel;
    }

    public static function obterUsuario($email) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("SELECT * FROM tb_user WHERE email = ?");
            $sql->execute([$email]);
            $usuario = $sql->fetch(PDO::FETCH_ASSOC);

            $usuario['xp_para_proximo_nivel'] = self::calcularProximoNivel($usuario['xp']);
            return $usuario;
        } catch (PDOException $e) {
            error_log("Erro ao obter informações do usuário: " . $e->getMessage());
            return [];
        }
    }

    public static function obterTodosUsuarios() {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("SELECT * FROM tb_user");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao obter todos os usuários: " . $e->getMessage());
            return [];
        }
    }

    public static function atualizarCargo($user_id, $novo_cargo) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("UPDATE tb_user SET cargo = ? WHERE id = ?");
            return $sql->execute([$novo_cargo, $user_id]);
        } catch (PDOException $e) {
            error_log("Erro ao atualizar cargo do usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function excluirUsuario($user_id) {
        try {
            $pdo = MySql::conectar();
            $sql = $pdo->prepare("DELETE FROM tb_user WHERE id = ?");
            return $sql->execute([$user_id]);
        } catch (PDOException $e) {
            error_log("Erro ao excluir usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>
