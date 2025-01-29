<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro do Sistema</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/style/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <img class="logo" src="<?php echo INCLUDE_PATH; ?>/public/logos/Nutribox logo laranja.png" alt="Logo Nutribox">
            <h2>Crie sua conta</h2>
            <p>Preencha os dados abaixo para se cadastrar.</p>
            <form method="post">
                <label for="name" class="title">Usuário:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email" class="title">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password" class="title">Senha:</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="Cadastrar agora" class="btn-submit">
            </form>
            <p class="signup-link">Já tem uma conta? <a href="login">Login</a></p>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    if (Usuario::cadastrarUsuario($name, $password, $email)) {
                        echo '<p class="success">Cadastro bem-sucedido! <a href="login">Faça login</a>.</p>';
                    } else {
                        echo '<p class="error">Erro no cadastro. O email já está em uso.</p>';
                    }
                }
            ?>
        </div>
        <div class="login-image">
            <img src="<?php echo INCLUDE_PATH; ?>/public/image/login.jpg" alt="Imagem de alimentos">
        </div>
    </div>
</body>
</html>
