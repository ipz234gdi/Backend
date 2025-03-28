<?php
require_once 'db.php';

$sql = "SELECT * FROM tov";
$result = $pdo->query($sql);

$task1 = '';
if(isset($_SESSION['user_id'])) {
    $task1 .= "Привіт, " . htmlspecialchars($_SESSION['username']) . "!";
    $task1 .= ' <a href="labs/Lab_5/profile.php">Змінити дані</a> | <a href="labs/Lab_5/logout.php">Вихід</a>';
} else {

$task1 .= '
<h2>Вхід</h2>
  <form action="labs/Lab_5/login.php" method="post">
    <label>Логін:</label><br>
    <input type="text" name="username" required><br>
    <label>Пароль:</label><br>
    <input type="password" name="password" required><br>
    <input type="submit" value="Увійти">
  </form>
  <p><a href="labs/Lab_5/register.php">Реєстрація</a></p>';
}

$task2 = '

  
<table border="1">
    <tr>
      <th>Номер</th>
      <th>Назва</th>
      <th>Ціна</th>
      <th>Кількість</th>
      <th>Дата додавання</th>
    </tr>';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $task2 .= '<tr>';
    $task2 .= '<td>' . $row["id"] . '</td>';
    $task2 .= '<td>' . htmlspecialchars($row["name"]) . '</td>';
    $task2 .= '<td>' . $row["cost"] . '</td>';
    $task2 .= '<td>' . $row["kol"] . '</td>';
    $task2 .= '<td>' . $row["date"] . '</td>';
    $task2 .= '</tr>';
}

$task2 .= '
</table>

<br>
<!-- Кнопка (посилання) для переходу до форми додавання -->
<form action="labs/Lab_5/insert.php" method="get" style="display:inline;">
    <input type="submit" value="Додати запис">
</form>

<!-- Поле й кнопка для видалення запису -->
<form action="labs/Lab_5/delete.php" method="post" style="display:inline;">
    <br>
    <br><label>Вилучити запис: </label>
    <input type="number" name="record_id" placeholder="№ запису" required>
    <input type="submit" value="Вилучити">
</form>
';

$task3 = '<a href="labs/Lab_5/employees">Employees</a>';


?>
