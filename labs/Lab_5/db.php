<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=lab5;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Помилка: " . $e->getMessage();
    exit;
}
?>
