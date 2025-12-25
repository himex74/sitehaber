<?php
session_start();
require_once 'db.php';
// Hataları gizle (Sunumda temiz görünmesi için)
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haber Portalı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .navbar { margin-bottom: 30px; }
        .footer { background: #343a40; color: white; padding: 20px 0; margin-top: 50px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">HABER PORTALI</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="index.php?p=home">Anasayfa</a>
            <a class="nav-link" href="index.php?p=haber_ekle">Haber Ekle</a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a class="nav-link btn btn-primary btn-sm text-white ms-2" href="index.php?p=login">Giriş Yap</a>
            <?php else: ?>
                <a class="nav-link text-warning" href="logout.php">Çıkış (<?php echo $_SESSION['username'] ?? 'Admin'; ?>)</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container" style="min-height: 600px;">
    <?php 
    $p = $_GET['p'] ?? 'home';
    $path = "pages/$p.php";
    if (file_exists($path)) { include $path; } else { include "pages/home.php"; }
    ?>
</div>

<footer class="footer text-center">
    <div class="container"><p>© 2025 İnternet Tabanlı Programlama Final Projesi</p></div>
</footer>
</body>
</html>