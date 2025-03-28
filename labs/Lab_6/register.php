<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$username = trim($data['username']);
$email = trim($data['email']);
$password = trim($data['password']);

if (!$username || !$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Invalid data"]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(["status" => "error", "message" => "Password is small"]);
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount()) {
    echo json_encode(["status" => "error", "message" => "Email already exists"]);
    exit;
}

$hash = password_hash($password, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hash]);

echo json_encode(["status" => "success"]);
?>
