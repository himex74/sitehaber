<?php
require_once 'db.php';

try {
    // Mevcut admini silelim ki çakýþmasýn
    $pdo->exec("DELETE FROM users WHERE username = 'admin'");
    
    // Tertemiz bir admin hesabý ekleyelim
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES ('admin', '123456', 'Admin')");
    $stmt->execute();
    
    echo "<h1>Baþarýlý!</h1><p>Admin hesabý sýfýrlandý. Artýk <b>admin</b> ve <b>123456</b> ile giriþ yapabilirsin.</p>";
    echo "<a href='index.php?p=login'>Giriþ Sayfasýna Git</a>";
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>