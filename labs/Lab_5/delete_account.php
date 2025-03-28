<?php
session_start();
require_once 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php?lab=5");
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if($stmt->execute([$_SESSION['user_id']])){
        session_destroy();
        header("Location: ../../index.php?lab=5");
        exit;
    } else {
        $error = "Не вдалося видалити профіль!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Видалення профілю</title>
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
    text-align: center;
}

h2 {
    color: #e74c3c;
    padding-bottom: 10px;
    margin-bottom: 25px;
    border-bottom: 2px solid #e74c3c;
}

form {
    margin: 30px 0;
}

input[type="submit"] {
    background-color: #e74c3c;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #c0392b;
}

p {
    margin: 20px 0;
}

a {
    color: #3498db;
    text-decoration: none;
    display: inline-block;
    padding: 12px 24px;
    background-color: #f8f8f8;
    border-radius: 4px;
    transition: all 0.3s;
    border: 1px solid #ddd;
    font-size: 16px;
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
    margin: 0 auto 20px auto;
    border-radius: 4px;
    max-width: 80%;
    text-align: left;
}
</style>
<body>
  <h2>Точно видалити профіль?</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post" action="">
    <input type="submit" value="Так, видалити">
  </form>
  <p><a href="profile.php">Ні, повернутись</a></p>
</body>
</html>
