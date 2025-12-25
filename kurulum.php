<?php
// Hata raporlamayý açalým (Sorun olursa görmek için)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Kurulum iþlemi baþlatýlýyor...<br>";

// Baðlantý Bilgileri
$host = '127.0.0.1';
$user = 'root';
$pass = ''; // Þifreyi sýfýrladýðýn için burayý boþ býraktýk
$port = '3307'; // Senin belirttiðin port

try {
    // 1. Adým: MySQL Sunucusuna Baðlan (Veritabaný olmadan)
    $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Adým: Veritabanýný Oluþtur
    $pdo->exec("CREATE DATABASE IF NOT EXISTS haber_db CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci");
    $pdo->exec("USE haber_db");
    echo "Veritabaný hazýr (haber_db).<br>";

    // 3. Adým: Kullanýcýlar Tablosunu Oluþtur
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('Admin', 'Editor', 'User') DEFAULT 'User'
    )");
    echo "Kullanýcýlar tablosu hazýr.<br>";

    // 4. Adým: Haberler Tablosunu Oluþtur
    $pdo->exec("CREATE TABLE IF NOT EXISTS news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Haberler tablosu hazýr.<br>";

    // 5. Adým: Örnek Admin Hesabý Ekle (Eðer yoksa)
    $checkUser = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $checkUser->execute();
    if ($checkUser->rowCount() == 0) {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES ('admin', '123456', 'Admin')");
        $stmt->execute();
        echo "Örnek admin hesabý oluþturuldu (Kullanýcý: admin, Þifre: 123456).<br>";
    }

    echo "<br><strong>Sistem baþarýyla kuruldu!</strong> Artýk projenin geri kalanýna geçebilirsin.";

} catch (PDOException $e) {
    // Baðlantý hatasý olursa burasý çalýþýr
    die("Maalesef bir hata oluþtu!<br>Hata Mesajý: " . $e->getMessage());
}
?>