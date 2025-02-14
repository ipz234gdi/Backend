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
    $square = "<div style='position: relative; width: 100%; height: 100vh; background-color: black;'>";
    for ($i = 0; $i < $n; $i++) {
        $size = mt_rand(20, 100); // Випадковий розмір квадрату
        $top = mt_rand(0, 90); // Випадкове розташування
        $left = mt_rand(0, 90);

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

?>