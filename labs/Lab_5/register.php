<?php
session_start();
require_once 'db.php'; // Файл з підключенням до БД

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if(empty($username) || empty($email) || empty($_POST['password'])){
        $error = "Заповни всі поля!";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            $error = "Такий Користувач уже існує!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
            if($stmt->execute([$username, $email, $password])){
                header("Location: ../../index.php?lab=5");
                exit;
            } else {
                $error = "Помилка реєстрації!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Реєстрація</title>
</head>
<style>
    body {
    font-family: 'Roboto', Arial, sans-serif;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    color: #333;
}

h2 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 25px;
}

form {
    background-color: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

p {
    margin: 15px 0;
}

a {
    color: #3498db;
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
    background-color: #f8f8f8;
    border-radius: 4px;
    transition: all 0.3s;
    border: 1px solid #ddd;
}

a:hover {
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-color: #3498db;
}

.error-message {
    color: #e74c3c;
    background-color: #fde9e7;
    padding: 10px;
    border-left: 4px solid #e74c3c;
    margin-bottom: 20px;
    border-radius: 4px;
}
</style>
<body>
  <h2>Реєстрація</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post" action="">
    Логін: <input type="text" name="username"><br>
    Email: <input type="email" name="email"><br>
    Пароль: <input type="password" name="password"><br>
    <input type="submit" value="Зареєструватися">
  </form>
  <p><a href="../../index.php?lab=5">На головну</a></p>
</body>
</html>
