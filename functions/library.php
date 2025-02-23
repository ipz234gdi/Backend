<?php
function curhrntodoll($hrn){
    return number_format($hrn / 42, 2, '.', '');
}

function ismounth($month) {
    if ($month >= 3 && $month <= 5) {
        return "Весна";
    } elseif ($month >= 6 && $month <= 8) {
        return "Літо";
    } elseif ($month >= 9 && $month <= 11) {
        return "Осінь";
    } else {
        return "Зима";
    }
}

function isholos($letter) {
    switch (strtolower($letter)) {
        case 'a': case 'e': case 'i': case 'o': case 'u': // Голосні
            return "Голосна";
        case 'y': 
            return "Може бути голосною або приголосною";
        default:
            return "Приголосна";
    }
}

function generateTable($rows, $cols) {
    $table = "<table border='1' style='border-collapse: collapse;'>";
    for ($i = 0; $i < $rows; $i++) {
        $table .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = sprintf("#%06X", mt_rand(0, 0xFFFFFF)); // Випадковий колір
            $table .= "<td style='width: 50px; height: 50px; background-color: $color;'></td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table>";
    return $table;
}

function generateSquares($n) {
    $square = "<div style='position: relative; width: 100%; height: 50vh; background-color: black;'>";
    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100); // Випадковий розмір квадрату
        $top = mt_rand(10, 90); // Випадкове розташування
        $left = mt_rand(10, 90);

        $square .= "<div style='
            position: absolute;
            width: {$size}px;
            height: {$size}px;
            background-color: red;
            top: {$top}%;
            left: {$left}%;
        '></div>";
    }
    $square .= "</div>";
    return $square;
}

// Завдання 1.5
function isStrongPassword($password) {
    return preg_match('/[A-Z]/', $password) && 
           preg_match('/[a-z]/', $password) && 
           preg_match('/[0-9]/', $password) && 
           preg_match('/[!@#$%^&*()\\-_]/', $password) &&
           strlen($password) >= 8;
}

// Завдання 2.1:
function findDuplicat($array) {
    $counts = array_count_values($array);
    return array_keys(array_filter($counts, fn($count) => $count > 1));
}

// Завдання 2.2:
function petName($sclady) {
    shuffle($sclady);
    return implode('', array_slice($sclady, 0, rand(2, 4)));
}

// Завдання 2.3:
function createArray() {
    $length = rand(3, 7);
    return array_map(fn() => rand(10, 20), range(1, $length));
}

function Newsortarray($array1, $array2) {
    $mergedArray = array_values(array_unique(array_merge($array1, $array2), SORT_NUMERIC));
    sort($mergedArray);
    return $mergedArray;
}

// Завдання 2.4:
function sortAssociativeArray(&$array, $sortBy) {
    if ($sortBy === "age") {
        asort($array);
    } elseif ($sortBy === "name") {
        ksort($array);
    }
}

// Завдання 4.1
function factorial($x) {
    if ($x < 0) return "Помилка: x має бути ≥ 0";
    if ($x == 0 || $x == 1) return 1;
    return $x * factorial($x - 1);
}

function stepen($x, $y) {
    return pow($x, $y);
}

function my_tg($x) {
    if (cos($x) == 0) return "Не визначено";
    return sin($x) / cos($x);
}

function my_sin($x) {
    return sin($x);
}

function my_cos($x) {
    return cos($x);
}

function my_tan($x) {
    if (cos($x) == 0) return "Не визначено";
    return tan($x);
}

?>