<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriBox</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>/public/style/style.css">
    <script src="https://kit.fontawesome.com/d9dda7c4a9.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="sidebar">
    <div class="profile">
        <a href="perfil" style="text-decoration: none;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Placeholder_no_text.svg/1024px-Placeholder_no_text.svg.png" alt="Profile Picture">
            <h2>Seu Nome Top Aqui</h2>
            <h3>Admin</h3>
            <a href="<?php echo INCLUDE_PATH; ?>logout.php" class="logout-button">Sair</a>
        </a>
    </div>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>"><i class="fa-solid fa-burger"></i> Cardapio</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>carrinho"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>marmitas"><i class="fa-solid fa-bowl-food"></i> Marmitas</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>pedidos"><i class="fa-regular fa-calendar-check"></i> Pedidos</a></li>
        </ul>
    </nav>
    <img class="logo" src="<?php echo INCLUDE_PATH; ?>/public/logos/Nutribox.png" alt="Nutribox">
</div>
</body>
</html>
