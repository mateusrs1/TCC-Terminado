<?php
include("config.php");
include("components/sidebar.php");

$url = isset($_GET['url']) ? $_GET['url'] : 'index';
$pagePath = "pages/" . $url . ".html";

if (file_exists($pagePath)) {
    include($pagePath);
} else {
    include("pages/404.html");
}

include("components/footer.php");
