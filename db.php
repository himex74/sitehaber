<?php
$host = 'localhost';
$db   = 'haber_db';
$user = 'root';
$pass = ''; // XAMPP'ta þifre genelde boþtur
$charset = 'utf8mb4';

try {
     $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
     die("Baðlantý baþarýsýz: " . $e->getMessage());
}
?>
