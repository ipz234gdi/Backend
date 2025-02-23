<?php
session_start();
$Header = '
<a href="http://labs.local/?lab=1" class="btn">Lab_1</a>
<a href="http://labs.local/?lab=2" class="btn">Lab_2</a>
<a href="http://labs.local/?lab=3" class="btn">Lab_3</a>
';
$Title = 'Hub';

if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
    switch ($lab) {
        case 1:
            $Title = 'Lab_1';
            //$result = 'done';
            include 'labs/Lab_1.php';
            break;
        case 2:
            $Title = 'Lab_2';
            //$result = 'done';
            include 'labs/Lab_2.php';
            break;
        case 3:
            $Title = 'Lab_3';
            //$result = 'done';
            include 'labs/Lab_3.php';
            break;
    }

} else {
    //$menu = $Header;
}

//Завдання 3.2 вихід
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header("Location: index.php");
    exit;
}

// Завдання 2.5 Встановлення мови
if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time() + (180 * 24 * 60 * 60), "/"); // Кукі на 6 місяців
    header("Location: index.php"); // Оновлення сторінки
    exit;
}

$lang = $_COOKIE['lang'] ?? 'ukr';

$languages = [
    "ukr" => ["name" => "Українська", "flag" => "https://flagcdn.com/w40/ua.png"],
    "pol" => ["name" => "Polski", "flag" => "https://flagcdn.com/w40/pl.png"],
    "eng" => ["name" => "English", "flag" => "https://flagcdn.com/w40/us.png"],
    "deu" => ["name" => "Deutsch", "flag" => "https://flagcdn.com/w40/de.png"],
    "fra" => ["name" => "Français", "flag" => "https://flagcdn.com/w40/fr.png"],
];

$languageText = "Вибрана мова: " . $languages[$lang]['name'];

$login = $_SESSION['login'] ?? '';
$gender = $_SESSION['gender'] ?? 'male';
$city = $_SESSION['city'] ?? 'Житомир';
$games = $_SESSION['games'] ?? [];
$about = $_SESSION['about'] ?? '';

$fontSize = $_COOKIE['fontSize'] ?? '16px';
include 'template/main.php';
?>