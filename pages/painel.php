<?php

if($_SESSION['cargo'] === "ADMIN") { ?>
    Oi admin!
<?php } else {
    header('Location: '.INCLUDE_PATH);
}