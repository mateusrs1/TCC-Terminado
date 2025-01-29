<?php
if (!isset($_SESSION['cargo'])) {
    header('Location: ' . INCLUDE_PATH . 'logout');
    exit();
}

$email = $_SESSION['email'];
$usuario = Usuario::obterUsuario($email);

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
?>

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
            <img src="<?php echo $_SESSION['img']; ?>" alt="Foto de Perfil">
            <h2><?php echo $_SESSION['nome']; ?></h2>
            <h3><?php echo $_SESSION['cargo']; ?></h3>
            <h3>Nível <?php echo $_SESSION['nivel']; ?></h3>
            <p>XP: <?php echo $_SESSION['xp']; ?></p>
            <p>Faltam <?php echo $usuario['xp_para_proximo_nivel']; ?> XP para o próximo nível</p>
            <a href="<?php echo INCLUDE_PATH; ?>logout.php" class="button">Sair</a>
            <?php if ($_SESSION['cargo'] === 'ADMIN') { ?>
                <a href="<?php echo INCLUDE_PATH; ?>painel" style="background: #FF5722" class="button">Painel</a>
            <?php } ?>
        </a>
    </div>
    <nav class="menu">
        <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>"><i class="fa-solid fa-burger"></i> Cardápio</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>carrinho"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>pedidos"><i class="fa-regular fa-calendar-check"></i> Pedidos</a></li>
        </ul>
    </nav>
    <img class="logo" src="<?php echo INCLUDE_PATH; ?>/public/logos/Nutribox.png" alt="Nutribox">
</div>
