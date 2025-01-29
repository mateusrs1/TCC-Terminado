<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro no Sistema</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/style/stylecadastro.css">
</head>
<body>
    <img class="logo" src="./sources/logos/Nutribox.png" alt="kiko">
    <div class="container">
        <h1>CADASTRO</h1>
        <form action="register.php" method="post">
            <label for="name" class="title">Usuário:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email" class="title">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password" class="title">Senha:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Cadastrar">
        </form>
    </div>

</body>
</html>