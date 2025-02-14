<?php
include __DIR__ . '/../functions/library.php';

// Task 1
$task1 = '<pre>Полину в мріях в купель океану,
Відчую <b>шовковистість</b> глибини,
 Чарівні мушлі з дна собі дістану,
   Щоб <b><i>взимку</i></b>
     <u>тішили</u>
        мене
          вони…
    </pre>';


// Task 2
$hrn = rand(1, 100);
$task2 = $hrn.' грн. можна обміняти на '.curhrntodoll($hrn).' долар';


// Task 3
$month = rand(1, 12);

$task3 = "Місяць №$month: ".ismounth($month);

// Task 4
$letter = chr(rand(97, 122));

$task4 = "Буква: $letter - ".isholos($letter);

// Task 5
$number = mt_rand(100, 999);

$digits = str_split($number);

// Сума цифр
$sum = array_sum($digits);

// Число у зворотному порядку
$reversed = implode('', array_reverse($digits));

// 3. Найбільше можливе число з цифр
rsort($digits); // Сортуємо цифри за спаданням
$max_number = implode('', $digits);

$task5 = "Випадкове число: $number<br>"."Сума цифр: $sum<br>"."Число у зворотному порядку: $reversed<br>"."Найбільше можливе число: $max_number<br>";


// Task 6

$task6 = generateTable(5, 5).generateSquares(10);

?>