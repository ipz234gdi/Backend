<?php
include __DIR__ . '/../functions/library.php';

// Завдання 1

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['text'], $_POST['find'], $_POST['replace'])) {
        $text = $_POST['text'];
        $find = $_POST['find'];
        $replace = $_POST['replace'];
        $result = str_replace($find, $replace, $text);
    }
    // Завдання 2

    if (isset($_POST['cities'])) {
        $cities = trim($_POST['cities']);
        if (!empty($cities)) {
            $citiesArray = explode(" ", $cities);
            sort($citiesArray);
            $sortedCities = implode(" ", $citiesArray);
        }
    }

    // Завдання 3

    if (isset($_POST['file_path'])) {
        $filePath = trim($_POST['file_path']);
        if (!empty($filePath)) {
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);
        }
    }

    // Завдання 4

    if (isset($_POST['date1'], $_POST['date2'])) {
        $date1 = DateTime::createFromFormat('d-m-Y', trim($_POST['date1']));
        $date2 = DateTime::createFromFormat('d-m-Y', trim($_POST['date2']));

        if ($date1 && $date2) {
            $interval = $date1->diff($date2);
            $daysDifference = $interval->days;
        } else {
            $daysDifference = "Некоректний формат дати. Використовуйте ДД-ММ-РРРР.";
        }
    }

    // Завдання 5

    if (isset($_POST['pass_length'])) {
        $length = (int) $_POST['pass_length'];

        if ($length >= 4 && $length <= 20) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_';
            $password = substr(str_shuffle(str_repeat($characters, ceil($length / strlen($characters)))), 0, $length);
            $passwordCheck = isStrongPassword($password) ? "Міцний пароль ✅" : "Слабкий пароль ❌";
        } else {
            $password = "Довжина пароля повинна бути від 4 до 20 символів.";
        }
    }
}



$task1 = "
    <form method='post'>
        <h3>Завдання 1.1: Заміна символів</h3>
        Текст: <input type='text' name='text'><br>
        Знайти: <input type='text' name='find'><br>
        Замінити: <input type='text' name='replace'><br>
        <input type='submit' value='Замінити'><br>      
    </form>
    <strong>Результат:</strong> " . ($result ?? '') . "<br>

    <form method='post'>
        <h3>Завдання 1.2: Впорядкування міст</h3>
        Введіть назви міст через пробіл: <br>
        <input type='text' name='cities' value=" . htmlspecialchars($_POST['cities'] ?? '') . "><br>
        <input type='submit' value='Відсортувати'><br>
    </form>
    <strong>Відсортовані міста:</strong>" . htmlspecialchars($sortedCities ?? '') . "

    <form method='post'>
        <h3>Завдання 1.3: Виділення імені файлу</h3>
        Введіть повний шлях до файлу: <br>
        <input type='text' name='file_path' value='" . htmlspecialchars($_POST['file_path'] ?? '') . "'><br>
        <input type='submit' value='Отримати назву'><br>
    </form>
    <strong>Ім'я файлу без розширення:</strong> " . htmlspecialchars($fileName ?? '') . "

    <form method='post'>
        <h3>Завдання 1.4: Кількість днів між датами</h3>
        Введіть першу дату (дд-мм-рррр): <br>
        <input type='text' name='date1' value='" . htmlspecialchars($_POST['date1'] ?? '') . "'><br>
        Введіть другу дату (дд-мм-рррр): <br>
        <input type='text' name='date2' value='" . htmlspecialchars($_POST['date2'] ?? '') . "'><br>
        <input type='submit' value='Обчислити дні'><br>
    </form>
    <strong>Різниця в днях:</strong> " . htmlspecialchars($daysDifference ?? '') . "

    <form method='post'>
        <h3>Завдання 1.5: Генератор паролів</h3>
        Вкажіть довжину пароля (4-20): <br>
        <input type='number' name='pass_length' min='4' max='20' value='" . htmlspecialchars($_POST['pass_length'] ?? 12) . "'><br>
        <input type='submit' value='Згенерувати'><br>
    </form>
    <strong>Згенерований пароль:</strong> " . htmlspecialchars($password ?? '') . " " . ($passwordCheck ?? '') . "
";

// Завдання 2.1
$sampleArray = [10, 12, 14, 10, 15, 14, 17];

// Завдання 2.2
$sclady = ["мі", "ка", "лу", "до", "ра", "чі", "зо"];

// Завдання 2.3
$array1 = createArray();
$array2 = createArray();
$sortedArray = Newsortarray($array1, $array2);

// Завдання 2.4
$users = ["Аліса" => 25, "Денис" => 20, "Діма" => 30, "Артем" => 22];
sortAssociativeArray($users, "age");

$task2 = "
    <h3>Завдання 2.1: Виведення повторюваних елементів масиву</h3>
    <p>Початковий масив: " . implode(", ", $sampleArray) . "</p>
    <p>Повторювані елементи: " . implode(", ", findDuplicat($sampleArray)) . "</p>

    <h3>Завдання 2.2: Генератор імен</h3>
    <p>Початковий масив складів: " . implode(", ", $sclady) . "</p>
    <p>Ім'я тварини: " . petName($sclady) . "</p>

    <h3>Завдання 2.3: Операції над масивами</h3>
    <p>Масив 1: " . implode(", ", $array1) . "</p>
    <p>Масив 2: " . implode(", ", $array2) . "</p>
    <p>Об’єднаний, унікальний та відсортований масив: " . implode(", ", $sortedArray) . "</p>

    <h3>Завдання 2.4: Сортування користувачів</h3>
    <p><strong>Сортування за віком:</strong></p>
    <ul>
";

foreach ($users as $name => $age) {
    $task2 .= "<li>$name: $age років</li>";
}

$task2 .= "</ul>";

sortAssociativeArray($users, "name");
$task2 .= "
    <p><strong>Сортування за іменем:</strong></p>
    <ul>
";
foreach ($users as $name => $age) {
    $task2 .= "<li>$name: $age років</li>";
}

$task2 .= "</ul>";

// ----------------------------------------------------


$task3 = "
    <button onclick='toggleform()' class='btn'>Profile</button>
";

$task4 = "
<h2>Введіть значення x та y</h2>
<form action='functions/calculate.php' method='post'>
    <label>x:</label>
    <input type='number' name='x' required value='" . ($_SESSION['x'] ?? '') . "'>
    
    <label>y:</label>
    <input type='number' name='y' required value='" . ($_SESSION['y'] ?? '') . "'>
    
    <button type='submit'>=</button>
</form>
" . ($_SESSION['result'] ?? '') . "
";
?>