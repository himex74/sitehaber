<?php
session_start(); // Oturum yönetimi için þart [cite: 9]
require_once 'db.php'; // Veritabaný baðlantýsý [cite: 13]

// Kullanýcý rolleri için varsayýlan yetki tanýmlama 
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'User'; 
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Sitesi - Final Projesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { min-height: 80vh; padding: 20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Haber Portalý</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php?p=home">Anasayfa</a></li>
                
                <?php if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Editor'): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?p=haber_ekle">Haber Ekle</a></li>
                <?php endif; ?>

                <?php if ($_SESSION['role'] == 'User' && !isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?p=login">Giriþ Yap</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Çýkýþ (<?php echo $_SESSION['role']; ?>)</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container main-content bg-white shadow-sm mt-4">
    <?php 
    // URL'deki 'p' parametresine göre sayfayý getir (Örn: index.php?p=haber_ekle)
    $sayfa = isset($_GET['p']) ? $_GET['p'] : 'home';
    $dosya_yolu = "pages/" . $sayfa . ".php";

    if (file_exists($dosya_yolu)) {
        include $dosya_yolu; // Alt sayfalar index.php içerisinde açýlýr 
    } else {
        include "pages/home.php"; // Dosya yoksa ana sayfayý göster
    }
    ?>
</div>

<footer class="text-center p-3 mt-4 bg-light">
    <p>&copy; 2025 Ýnternet Tabanlý Programlama Final Projesi</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>