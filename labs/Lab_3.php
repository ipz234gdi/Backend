<?php
// Завдання 1

$task1 = '<h3>Завдання 1.1: Вибір розміру тексту</h3>';
if (isset($_GET['size'])) {
    $size = $_GET['size'];
    $lab = $_GET['lab'];
    setcookie('fontSize', $size, time() + (86400 * 30), "/");
    header("Location: index.php" . "?lab=" . urlencode($lab));
    exit;
}


$task1 .= '
    <a href="?lab=3&size=20px">Великий шрифт</a> |
    <a href="?lab=3&size=16px">Середній шрифт</a> |
    <a href="?lab=3&size=12px">Маленький шрифт</a>
';


// Завдання 2
$task2 = '<h3>Завдання 2.1: Авторизація</h3>';

if ($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST['login2'])) {
    $login = $_POST['login2'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['user'] = $login;
    } else {
        $_SESSION['error2_2'] = "Невірний логін або пароль!";
    }
    header("Location: index.php" . "?lab=3");
    exit;
}

if (isset($_SESSION['user'])) {
    $task2 .= "<h2>Добрий день, " . htmlspecialchars($_SESSION['user']) . "!</h2>";
    $task2 .= '<a href="?logout=true">Вийти</a>';
} else {
    $task2 .= '
        <h2>Авторизація</h2>
        <form method="post">
            Логін: <input type="text" name="login2" required><br>
            Пароль: <input type="password" name="password" required><br>
            <input type="submit" value="Увійти">
        </form>
    ';

    if (isset($_SESSION['error2_2'])) {
        $task2 .= '<p style="color: red;">' . htmlspecialchars($_SESSION['error2_2']) . '</p>';
        unset($_SESSION['error2_2']);
    }
}

// Завдання 3.1
$task3 = '<h3>Завдання 3.1: Записування в файл і читання з нього</h3>';

$filename = "comments.txt";

if ($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST['name'])) {
    $name = trim($_POST["name"] ?? '');
    $comment = trim($_POST["comment"] ?? '');

    if (!empty($name) && !empty($comment)) {
        $entry = "$name|$comment\n";
        file_put_contents($filename, $entry, FILE_APPEND);
    }
}

$comments = [];
if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        $parts = explode("|", trim($line));
        if (count($parts) == 2) {
            $comments[] = $parts;
        }
    }
    $comments = array_reverse($comments);
    fclose($file);
}


$task3 .= '
    <h2>Додати коментар</h2>
    <form method="post">
        Імя: <input type="text" name="name" required><br>
        Коментар: <textarea name="comment" required></textarea><br>
        <input type="submit" value="Надіслати">
    </form>

    <h2>Коментарі</h2>
    <table border="1">
        <tr>
            <th>Імя</th>
            <th>Коментар</th>
        </tr>

';

foreach ($comments as $c):
    $task3 .= '<tr>
        <td>' . htmlspecialchars($c[0]) . '</td>
        <td>' . htmlspecialchars($c[1]) . '</td>
    </tr>';
endforeach;

$task3 .= '</table>';

// Завдання 3.2
$task3 .= '<h3>Завдання 3.2: створення і взаємодія з файлами</h3>';

$file1 = "file1.txt";
$file2 = "file2.txt";

$words1 = explode(" ", file_get_contents($file1));
$words2 = explode(" ", file_get_contents($file2));

$words1 = array_map('trim', $words1);
$words2 = array_map('trim', $words2);

// echo implode(" ", $words1) . " | " . implode(" ", $words2);

$onlyFirst = array_diff($words1, $words2);
$onlyBoth = array_intersect($words1, $words2);

$word1Counts = array_count_values($words1);
$word2Counts = array_count_values($words2);
$more1word1 = array_keys(array_filter($word1Counts, fn($count) => $count > 1));
$more1word2 = array_keys(array_filter($word2Counts, fn($count) => $count > 1));

$moreTwice = array_intersect($more1word1 ,$more1word2);

$task3 .= '
<h2>Створити файли</h2>
<form method="post">
    <button name="create_files">Створити!</button>
</form>
';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file_name"])) {
    if(isset($_POST['file_name'])){
        $fileToDelete = $_POST["file_name"];
        $filePath = dirname(__DIR__) . '/' . $fileToDelete;
    
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                $task3 .= "<p style='color: green;'>Файл $fileToDelete успішно видалено!</p>";
            } else {
                $task3 .= "<p style='color: red;'>Помилка: неможливо видалити файл $filePath.</p>";
            }
        } else {
            $task3 .= "<p style='color: red;'>Помилка: Файл $filePath не знайдено!</p>";
        }
    }
    if(isset($_POST['create_files'])){
        file_put_contents("only_first.txt", implode(" ", $onlyFirst));
        file_put_contents("only_both.txt", implode(" ", $onlyBoth));
        file_put_contents("moreTwice.txt", implode(" ", $moreTwice));
        $task3 .= "<p style='color: green;'>Файли створенно!</p>";
    }
    header("Location: index.php" . "?lab=3");
    exit;
}

$task3 .= '
    <h2>Видалити файл</h2>
    <form method="post">
        <select name="file_name">
            <option value="only_first.txt">only_first.txt</option>
            <option value="only_both.txt">only_both.txt</option>
            <option value="moreTwice.txt">moreTwice.txt</option>
        </select>
        <input type="submit" value="Видалити">
    </form>
';

// Завдання 3.3
$task3 .= '<h3>Завдання 3.3: Сортування слів</h3>';
$inputFile = "words.txt";
$outputFile = "sorted_words.txt";

$words = explode(" ", file_get_contents($inputFile));
sort($words);
file_put_contents($outputFile, implode(" ", $words));

$task3 .= "Файл відсортовано!";

// Завдання 4
$task4 = 'Завдання 4.1 завантаження файлу';
$uploadDir = "uploads/";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $file = $_FILES["image"];
    $fileExt = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    $newFileName = uniqid("img_", true) . "." . $fileExt;
    $uploadPath = $uploadDir . $newFileName;

    if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
        header("Location: index.php" . "?lab=3");
    } else {
        $task4 .= " | Помилка при завантаженні!";
    }
}

$task4 .= '
    <h2>Завантажити зображення</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <br><br>
        <input type="submit" value="Завантажити">
    </form>
';

// Завдання 5
$task5 = 'Завдання 5.1 авторизація і створення файлів';

$baseDir = "users";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login5"])) {
    $login = trim($_POST["login5"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if (empty($login) || empty($password)) {
        $_SESSION['error2_5'] = "Логін і пароль не можуть бути порожні!";
    } else {
        $userDir = "$baseDir/$login";

        if (file_exists($userDir)) {
            $_SESSION['error2_2'] = "Невірний логін або пароль!";
            $_SESSION['error2_5'] = "Користувач з таким логіном вже існує!";
        } else {
            mkdir($userDir, 0777, true);
            mkdir("$userDir/video");
            mkdir("$userDir/music");
            mkdir("$userDir/photo");

            file_put_contents("$userDir/video/video1.txt", "Файл відео");
            file_put_contents("$userDir/music/music1.txt", "Файл музики");
            file_put_contents("$userDir/photo/photo1.txt", "Файл фото");

            $_SESSION['success2_5'] = "Реєстрація успішна! Папка користувача створена.";
        }
    }
    // $_SESSION['error2_5'] = "Користувач з таким логіном вже існує!";
    header("Location: index.php?lab=3");
    exit;
}

$task5 .= '
    <h2>Реєстрація</h2>

    <form method="post">
        Логін: <input type="text" name="login5" required><br>
        Пароль: <input type="password" name="password" required><br>
        <input type="submit" value="Зареєструватися">
    </form>
    <a href="../functions/delete.php">Форма видалення</a>
';

if (isset($_SESSION['error2_5'])) {
    $task5 .= '<p style="color: red;"> ' .  htmlspecialchars($_SESSION['error2_5']) . '</p>';
    unset($_SESSION['error2_5']);
}

if (isset($_SESSION['success2_5'])) {
    $task5 .= '<p style="color: green;"> ' .  htmlspecialchars($_SESSION['success2_5']) . '</p>';
    unset($_SESSION['success2_5']);
}


?>