<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=lab5;charset=utf8", "root", "");
    $pdonotes = new PDO("mysql:host=localhost;dbname=notes_app;charset=utf8", "root", "");
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    exit;
}
?>
