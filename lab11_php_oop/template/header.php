<!DOCTYPE html>
<html>
<head>
    <title>Modular Framework Lab 11</title>
    <link rel="stylesheet" href="/lab11_php_oop/assets/css/style.css">
</head>
<body>

<div class="container">
<header>
    <h2>Modular Framework Lab 11</h2>
    <nav>
    <a href="/lab11_php_oop/">Home</a>

    <?php if (isset($_SESSION['is_login'])): ?>
        | <a href="/lab11_php_oop/artikel/index">Artikel</a>
        | <a href="/lab11_php_oop/user/profile">Profil</a>
        | <a href="/lab11_php_oop/user/logout">
            Logout (<?= $_SESSION['nama'] ?>)
          </a>
    <?php else: ?>
        | <a href="/lab11_php_oop/user/login">Login</a>
    <?php endif; ?>
</nav>

</header>
<hr>
