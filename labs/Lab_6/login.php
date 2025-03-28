<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['email']);
$password = trim($data['password']);

if (!$email || !$password) {
    echo json_encode(["status" => "error", "message" => "Заповніть всі поля"]);
    exit;
}

// Перевіряємо, чи існує email
$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Логін успішний, можна зберегти сесію (якщо треба)
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    echo json_encode([
        "status" => "success",
        "message" => "Логін успішний",
        "user" => [
            "id" => $user['id'],
            "username" => $user['username'],
            "email" => $email
        ]
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Невірний email або пароль"]);
}
?>