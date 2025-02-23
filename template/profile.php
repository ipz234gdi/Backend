<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['games'] = $_POST['games'] ?? [];
    $_SESSION['about'] = $_POST['about'];

    // Перевірка паролів
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $password_status = "Пароль не співпадає (перший - " . strlen($password) . " символів, другий - " . strlen($confirm_password) . " символів)";
    } else {
        $password_status = "Пароль введено коректно";
    }

    // ✅ Обробка фотографії (тепер коректно)
    if (!empty($_FILES['photo']['tmp_name'])) {
        $uploadDir = "uploads/";

        // Створення папки, якщо її немає
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Отримання шляху файлу
        $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);

        // Переміщення файлу
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
            $_SESSION['photo'] = $uploadFile;
        } else {
            $_SESSION['photo'] = "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <title>Профіль користувача</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        border: none;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-direction: column;
        font-family: 'Arial', sans-serif;
        padding: 40px;
        background-color: #FF8383;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        font-size: 28px;
        margin-bottom: 30px;
        text-align: center;
        position: relative;
        padding-bottom: 10px;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background-color: #FF8383;
    }

    p {
        margin: 15px 0;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    p:hover {
        transform: translateX(10px);
    }

    strong {
        color: #FF4646;
        font-weight: 600;
        margin-right: 10px;
    }

    ul {
        list-style: none;
        margin: 15px 0;
        padding-left: 20px;
    }

    li {
        margin: 10px 0;
        padding: 8px 15px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 5px;
        position: relative;
    }

    li::before {
        content: '🎮';
        margin-right: 10px;
    }

    img {
        max-width: 200px;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        margin: 20px 0;
        transition: transform 0.3s ease;
    }

    img:hover {
        transform: scale(1.05);
    }

    a {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 25px;
        background-color: #FF4646;
        color: white;
        border-radius: 25px;
        font-weight: bold;
        transition: all 0.3s ease;
        text-align: center;
    }

    a:hover {
        background-color: #FF2929;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Стилі для блоку "Про себе" */
    /* p:has(+ p) {
        background-color: transparent;
        margin-bottom: 5px;
    } */

    p:has(+ p)+p {
        background-color: rgba(255, 255, 255, 0.7);
        padding: 15px;
        border-radius: 8px;
        white-space: pre-wrap;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    body>* {
        animation: fadeIn 0.5s ease forwards;
    }
</style>

<body>
    <h2>Ваш профіль</h2>
    <p><strong>Логін:</strong> <?= htmlspecialchars($_SESSION['login']) ?></p>
    <p><strong>Пароль:</strong> <?= $password_status ?></p>
    <p><strong>Стать:</strong> <?= ($_SESSION['gender'] == 'male') ? 'чоловік' : 'жінка' ?></p>
    <p><strong>Місто:</strong> <?= htmlspecialchars($_SESSION['city']) ?></p>

    <p><strong>Улюблені ігри:</strong></p>
    <ul>
        <?php foreach ($_SESSION['games'] as $game): ?>
            <li><?= htmlspecialchars($game) ?></li>
        <?php endforeach; ?>
    </ul>

    <p><strong>Про себе:</strong></p>
    <p><?= nl2br(htmlspecialchars($_SESSION['about'])) ?></p>

    <p><strong>Фотографія:</strong></p>
    <?php if (!empty($_SESSION['photo']) && file_exists($_SESSION['photo'])): ?>
        <img src="<?= $_SESSION['photo'] ?>" width="200">
    <?php else: ?>
        <p>Фото не завантажено або файл відсутній</p>
    <?php endif; ?>

    <br><br>
    <a href="/index.php">Повернутися на головну сторінку</a>

</body>

</html>