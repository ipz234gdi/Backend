<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $cost = (int)$_POST['cost'];
    $kol  = (int)$_POST['kol'];
    $date = $_POST['date']; // формат YYYY-MM-DD

    // Готуємо INSERT-запит
    $sql = "INSERT INTO tov (name, cost, kol, date) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $cost, $kol, $date])) {
        // Якщо успішно, повертаємося на головну сторінку
        header("Location: ../../index.php?lab=5");
        exit;
    } else {
        $error = "Помилка при додаванні запису!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Додати запис</title>
</head>
<style>
    body {
    font-family: 'Roboto', Arial, sans-serif;
    line-height: 1.6;
    max-width: 800px;
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
input[type="number"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #2ecc71;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #27ae60;
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
  <h2>Додати новий товар</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  
  <form method="post" action="">
    <p>Назва: <input type="text" name="name" required></p>
    <p>Ціна: <input type="number" name="cost" required></p>
    <p>Кількість: <input type="number" name="kol" required></p>
    <p>Дата (YYYY-MM-DD): <input type="date" name="date" required></p>
    <input type="submit" value="Додати">
  </form>
  
  <p><a href="../../index.php?lab=5">Повернутися назад</a></p>
</body>
</html>
