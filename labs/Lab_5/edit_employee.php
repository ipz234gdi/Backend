<?php
// edit_employee.php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Помилка: " . $e->getMessage());
}

if(isset($_POST['edit_form'])){
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE id=?");
    $stmt->execute([$id]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif(isset($_POST['edit'])){
    // Обробка форми редагування
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $salary = $_POST['salary'];
    $stmt = $pdo->prepare("UPDATE employees SET name=?, position=?, salary=? WHERE id=?");
    $stmt->execute([$name, $position, $salary, $id]);
    header("Location: employees.php");
    exit;
} else {
    header("Location: employees.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Редагувати працівника</title>
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
input[type="number"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #f39c12;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #d35400;
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
</style>
<body>
  <h2>Редагування даних працівника</h2>
  <form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
    Ім'я: <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>
    Посада: <input type="text" name="position" value="<?php echo htmlspecialchars($employee['position']); ?>" required><br>
    Зарплата: <input type="number" step="0.01" name="salary" value="<?php echo $employee['salary']; ?>" required><br>
    <input type="submit" name="edit" value="Оновити">
  </form>
  <p><a href="employees.php">Назад</a></p>
</body>
</html>
