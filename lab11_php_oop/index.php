<?php
session_start();

include "config.php";
include "class/database.php";
include "class/form.php";

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/artikel/index';
$segments = explode('/', trim($path, '/'));

$mod  = $segments[0] ?? 'artikel';
$page = $segments[1] ?? 'index';

$public_pages = ['user'];

if (!in_array($mod, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header("Location: /lab11_php_oop/user/login");
        exit;
    }
}

$file = "module/$mod/$page.php";

include "template/header.php";

if (file_exists($file)) {
    include $file;
} else {
    echo "<p>Modul tidak ditemukan: $mod/$page</p>";
}

include "template/footer.php";
