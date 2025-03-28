<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=trafficdb;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
?>
