<?php
$baseDir = dirname(__DIR__) . "/users";

function deleteFolder($folder)
{
    if (!is_dir($folder))
        return;
    foreach (scandir($folder) as $file) {
        if ($file == "." || $file == "..")
            continue;
        $path = "$folder/$file";
        is_dir($path) ? deleteFolder($path) : unlink($path);
    }
    rmdir($folder);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST["login"] ?? '');
    $password = trim($_POST["password"] ?? '');

    $userDir = "$baseDir/$login";

    if (empty($login) || empty($password)) {
        $error = "Логін і пароль не можуть бути порожні!";
    } elseif (!file_exists($userDir)) {
        $error = "Папка користувача не знайдена!";
    } else {
        deleteFolder($userDir);
        $success = "Папка '$login' успішно видалена!";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення папки</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
    }

    h2 {
        color: #444;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background: #d9534f;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background: #c9302c;
    }

    .message {
        margin-top: 10px;
        font-size: 14px;
    }

    .success {
        color: green;
    }

    .error {
        color: red;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<body>

    <h2>Видалити користувача</h2>

    <form method="post">
        Логін: <input type="text" name="login" required><br>
        Пароль: <input type="password" name="password" required><br>
        <input type="submit" value="Видалити">
    </form>

    <a href="../index.php?lab=3">вийти</a>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?= $success ?></p>
    <?php endif; ?>

</body>

</html>