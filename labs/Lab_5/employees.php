<?php
// employees.php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Помилка: " . $e->getMessage());
}

// Обробка додавання нового працівника
if(isset($_POST['add'])){
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $salary = $_POST['salary'];
    $stmt = $pdo->prepare("INSERT INTO employees (name, position, salary) VALUES (?,?,?)");
    $stmt->execute([$name, $position, $salary]);
    header("Location: employees.php");
    exit;
}

// Обробка редагування
if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $salary = $_POST['salary'];
    $stmt = $pdo->prepare("UPDATE employees SET name=?, position=?, salary=? WHERE id=?");
    $stmt->execute([$name, $position, $salary, $id]);
    header("Location: employees.php");
    exit;
}

// Обробка видалення
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM employees WHERE id=?");
    $stmt->execute([$id]);
    header("Location: employees.php");
    exit;
}

// Отримання даних
$result = $pdo->query("SELECT * FROM employees");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Працівники компанії</title>
  <style>
    table, th, td { border: 1px solid #ccc; border-collapse: collapse; padding: 8px; }
  </style>
</head>
<style>
    body {
    font-family: 'Roboto', Arial, sans-serif;
    line-height: 1.6;
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    color: #333;
}

h2, h3, h4 {
    color: #2c3e50;
    padding-bottom: 8px;
    margin-bottom: 20px;
}

h2 {
    border-bottom: 2px solid #3498db;
}

h3 {
    margin-top: 30px;
    border-bottom: 1px solid #ddd;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #3498db;
    color: white;
    font-weight: 500;
}

tr:hover {
    background-color: #f9f9f9;
}

tr:last-child td {
    border-bottom: none;
}

form {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0 16px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 15px;
}

input[type="submit"] {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

input[name="delete"] {
    background-color: #e74c3c;
    color: white;
    margin-right: 5px;
}

input[name="delete"]:hover {
    background-color: #c0392b;
}

input[name="edit_form"] {
    background-color: #f39c12;
    color: white;
}

input[name="edit_form"]:hover {
    background-color: #d35400;
}

input[name="add"] {
    background-color: #2ecc71;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
}

input[name="add"]:hover {
    background-color: #27ae60;
}

ul {
    background-color: white;
    padding: 15px 15px 15px 35px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

li {
    margin-bottom: 8px;
}

/* Для форм у таблиці */
td form {
    padding: 0;
    margin: 0;
    background: transparent;
    box-shadow: none;
}
</style>
<body>
  <h2>Список працівників</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Ім'я</th>
      <th>Посада</th>
      <th>Зарплата</th>
      <th>Дії</th>
    </tr>
    <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['position']); ?></td>
        <td><?php echo $row['salary']; ?></td>
        <td>
          <form style="display:inline;" method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="delete" value="Видалити">
          </form>
          <form style="display:inline;" method="post" action="edit_employee.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="edit_form" value="Редагувати">
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  
  <h3>Додати нового працівника</h3>
  <form method="post" action="">
    Ім'я: <input type="text" name="name" required><br>
    Посада: <input type="text" name="position" required><br>
    Зарплата: <input type="number" step="0.01" name="salary" required><br>
    <input type="submit" name="add" value="Додати">
  </form>
  
  <h3>Статистика</h3>
  <?php
    // Наприклад, середня зарплата
    $stmt = $pdo->query("SELECT AVG(salary) as avg_salary FROM employees");
    $avg = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Середня зарплата: " . number_format($avg['avg_salary'] ?? 0, 2);
    
    // Кількість працівників по посадах
    $stmt = $pdo->query("SELECT position, COUNT(*) as count FROM employees GROUP BY position");
    echo "<h4>Кількість по посадах:</h4><ul>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<li>" . htmlspecialchars($row['position']) . ": " . $row['count'] . "</li>";
    }
    echo "</ul>";
  ?>
  <a href="../../index.php?lab=5">Головна</a>
  
</body>
</html>
