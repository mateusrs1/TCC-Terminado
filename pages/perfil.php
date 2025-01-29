<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];
$usuario = Usuario::obterUsuario($email);

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $imagem = $usuario['img'];
    
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagemTmp = $_FILES['imagem']['tmp_name'];
        $imagemNome = basename($_FILES['imagem']['name']);
        $imagemDestino = 'uploads/' . $imagemNome;

        if (move_uploaded_file($imagemTmp, $imagemDestino)) {
            $imagem = $imagemDestino;
        } else {
            $mensagem = "<p>Erro ao fazer upload da imagem. A imagem atual será mantida.</p>";
        }
    }

    // Atualiza as informações do usuário
    if (Usuario::atualizarUsuario($nome, $senha, $endereco, $imagem)) {
        // Recarrega as informações do usuário atualizadas
        $usuario = Usuario::obterUsuario($email);
        $mensagem = "<p>Informações atualizadas com sucesso!</p>";
    } else {
        $mensagem = "<p>Erro ao atualizar informações. Tente novamente.</p>";
    }
}
?>

<div class="perfil-container">
    <h2>Perfil do Usuário</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha">
        <small>Caso não queira trocar a senha, coloque sua senha atual.</small>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required>
        
        <label for="imagem">Imagem de Perfil:</label>
        <input type="file" id="imagem" name="imagem">
        <br>
        <img src="<?php echo htmlspecialchars($usuario['img']); ?>" alt="Imagem de Perfil" width="100">
        
        <input type="submit" value="Atualizar Perfil">
    </form>
    
    <!-- Exibe a mensagem abaixo do formulário -->
    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?php echo $mensagem; ?></div>
    <?php endif; ?>
</div>
