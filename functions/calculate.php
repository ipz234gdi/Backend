<?php
session_start();
require 'library.php'; // Підключення власних функцій

// Отримання введених значень
$x = $_POST['x'];
$y = $_POST['y'];

// Збереження у сесії для зручності
$_SESSION['x'] = $x;
$_SESSION['y'] = $y;

// Обчислення значень
$xy = stepen($x, $y);
$x_fact = factorial($x);
$my_tg_x = my_tg($x);
$sin_x = my_sin($x);
$cos_x = my_cos($x);
$tg_x = my_tan($x);

// Формування HTML-таблиці для відображення результатів
$_SESSION['result'] = "
<table>
    <tr>
        <th>x<sup>y</sup></th>
        <th>x!</th>
        <th>my_tg(x)</th>
        <th>sin(x)</th>
        <th>cos(x)</th>
        <th>tg(x)</th>
    </tr>
    <tr>
        <td>$xy</td>
        <td>$x_fact</td>
        <td>$my_tg_x</td>
        <td>$sin_x</td>
        <td>$cos_x</td>
        <td>$tg_x</td>
    </tr>
</table>
";

// Повернення на головну сторінку для відображення
$task4 .= $_SESSION['result'];
header("Location: /index.php?lab=2");
exit;
?>
