<?php

class Usuario {
    public function atualizarUsuario($nome, $senha, $imagem) {
        try {
            $senhaParaAtualizar = !empty($senha) ? $senha : null;

            $sql = MySql::conectar()->prepare("UPDATE `tb_user` SET nome = ?, senha = ?, img = ? WHERE email = ?");
            return $sql->execute(array($nome, $senhaParaAtualizar, $imagem, $_SESSION['email']));
        } catch (PDOException $e) {
            // Log do erro
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function userExists($email) {
        try {
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_user` WHERE email = ?");
            $sql->execute(array($email));
            return $sql->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar existência do usuário: " . $e->getMessage());
            return false;
        }
    }

    public static function loginUsuario($email, $senha) {
        try {
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_user` WHERE email = ?");
            $sql->execute(array($email));
            
            if ($sql->rowCount() == 1) {
                $info = $sql->fetch();
                if ($senha === $info['senha']) {
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['img'] = $info['img'];
                    $_SESSION['nivel'] = $info['nivel'];
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
    
    public static function cadastrarUsuario($nome, $senha, $email) {
        try {
            if (self::userExists($email)) {
                return false;
            }

            $imagem = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Placeholder_no_text.svg/1024px-Placeholder_no_text.svg.png';
            $cargo = 'USUARIO';

            $sql = MySql::conectar()->prepare("INSERT INTO `tb_user` (nome, senha, img, email, cargo) VALUES (?, ?, ?, ?, ?)");
            return $sql->execute(array($nome, $senha, $imagem, $email, $cargo));
        } catch (PDOException $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
            return false;
        }
    }
}
