<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login do Sistema</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/style/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <img class="logo" src="<?php echo INCLUDE_PATH; ?>/public/logos/Nutribox logo laranja.png" alt="Logo Nutribox">
            <h2>Bem vindo de volta!</h2>
            <p>Faça login com seu email e sua senha.</p>
            <form method="post">
                <label for="name" class="title">Endereço de Email</label>
                <input type="text" id="name" name="name" required>
                
                <label for="password" class="title">Senha</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="Entrar agora" class="btn-submit">
            </form>
            <p class="signup-link">Não tem conta? <a href="cadastro">Cadastro</a></p>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $_POST['name'];
                    $password = $_POST['password'];

                    if ($email == 'admin' && $password == '1234') {
                        echo '<p class="success">Login bem-sucedido!</p>';
                        $_SESSION['login'] = true;
                        header("Refresh: 0");
                    } else {
                        echo '<p class="error">Nome de usuário ou senha incorretos.</p>';
                    }
                }
            ?>
        </div>
        <div class="login-image">
            <img src="<?php echo INCLUDE_PATH; ?>/public/image/login.jpg" alt="Food Image">
        </div>
    </div>
</body>
</html>
