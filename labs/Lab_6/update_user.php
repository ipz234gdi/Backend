<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$username = trim($data['username']);
$email = trim($data['email']);

$stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
$stmt->execute([$username, $email, $id]);

echo json_encode(["status" => "success"]);
?>
