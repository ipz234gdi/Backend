<?php
require_once 'db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $record_id = intval($_POST['record_id']);
    $stmt = $pdo->prepare("DELETE FROM tov WHERE id = ?");
    if($stmt->execute([$record_id])){
        header("Location: ../../index.php?lab=5");
        exit;
    } else {
        $error = "Не вдалося видалити запис!";
    }
}
?>