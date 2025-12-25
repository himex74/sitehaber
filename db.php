<?php
// PHP'nin tarayıcıya Türkçe harf göndermesini sağlar
header('Content-Type: text/html; charset=utf-8');

$host = '127.0.0.1';
$port = '3307'; // Sizin özel portunuz
$db   = 'haber_db';
$user = 'root';
$pass = ''; 
$charset = 'utf8mb4';

try {
     $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=$charset", $user, $pass);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $pdo->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
     die("⚠️ Veritabanı hatası: " . $e->getMessage());
}
?>