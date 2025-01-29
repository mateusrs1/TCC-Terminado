<?php if ($_SESSION['cargo'] === 'ADMIN' || $_SESSION['cargo'] === 'COZINHEIRO') { ?>
    Pedidos A fazer
<?php } else { ?>
    Meus Pedidos
<?php } ?>
