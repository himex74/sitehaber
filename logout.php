<?php
session_start(); // Mevcut oturumu bulur
session_unset(); // Tüm oturum deðiþkenlerini temizler
session_destroy(); // Oturumu tamamen yok eder

// Sizi ana sayfaya (giriþ yapýlmamýþ hale) geri gönderir
header("Location: index.php");
exit;
?>