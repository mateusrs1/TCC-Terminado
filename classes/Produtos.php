<?php

class Produtos {
    
    public function criarProduto($nome, $descricao, $preco, $imagem) {
        try {
            $imagemNome = self::uploadImagem($imagem);

            if ($imagemNome) {
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_produtos` (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
                return $sql->execute(array($nome, $descricao, $preco, $imagemNome));
            } else {
                error_log("Erro ao fazer upload da imagem.");
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erro ao criar produto: " . $e->getMessage());
            return false;
        }
    }

    public static function obterProdutos() {
        try {
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_produtos`");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            error_log("Erro ao obter produtos: " . $e->getMessage());
            return false;
        }
    }

    public static function deletarProduto($id) {
        try {
            $sql = MySql::conectar()->prepare("DELETE FROM `tb_produtos` WHERE id = ?");
            return $sql->execute(array($id));
        } catch (PDOException $e) {
            error_log("Erro ao deletar produto: " . $e->getMessage());
            return false;
        }
    }

    public static function atualizarProduto($id, $nome, $descricao, $preco, $imagem = null) {
        try {
            if ($imagem) {
                $imagemNome = self::uploadImagem($imagem);

                if (!$imagemNome) {
                    error_log("Erro ao fazer upload da imagem.");
                    return false;
                }

                $sql = MySql::conectar()->prepare("UPDATE `tb_produtos` SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?");
                return $sql->execute(array($nome, $descricao, $preco, $imagemNome, $id));
            } else {
                $sql = MySql::conectar()->prepare("UPDATE `tb_produtos` SET nome = ?, descricao = ?, preco = ? WHERE id = ?");
                return $sql->execute(array($nome, $descricao, $preco, $id));
            }
        } catch (PDOException $e) {
            error_log("Erro ao atualizar produto: " . $e->getMessage());
            return false;
        }
    }

    private static function uploadImagem($file, $dir = 'uploads/') {
        try {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $fileName = time() . '_' . basename($file['name']);
            $filePath = $dir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                return $fileName; 
            } else {
                error_log("Erro ao fazer upload do arquivo: " . $file['name']);
                return false;
            }
        } catch (Exception $e) {
            error_log("Erro na função de upload de imagem: " . $e->getMessage());
            return false;
        }
    }
}
