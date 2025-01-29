<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login do Sistema</title>

    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/style/style.css">
</head>
<body>
    <img class="logo" src="./sources/logos/Nutribox.png" alt="kiko">
    <div class="container">
        <h1>LOGIN</h1>
        <form action="login.php" method="post">
            <label for="name" class="title">Usuário:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="password" class="title">Senha:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Logar">
        </form>
    </div>
</body>
</html>