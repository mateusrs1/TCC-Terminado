<?php
include("config.php");

$url = isset($_GET['url']) ? $_GET['url'] : 'index';
$url = basename($url);
$pagePath = "pages/" . $url . ".html";

if (file_exists($pagePath) || file_exists("pages/" . $url . ".php")) {
    if ($url == 'cadastro' || $url == 'login') {
        include("pages/" . $url . ".php");
    } else {
        include("components/sidebar.php");
        include($pagePath);
        include("components/footer.php");
    }
} else {
    include("pages/404.html");
}