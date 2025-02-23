<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?></title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        border: none;
    }

    body {
        display: flex;
        flex-direction: column;
        font-family: 'Arial', sans-serif;
        font-size: <?= htmlspecialchars($fontSize ?? '16px') ?>;;
        padding: 20px;
        background-color: #FF8383;
        /* color: rgb(255, 255, 255); */
    }

    a {}

    header {
        background-color: #A19AD3;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn {
        background-color: #6C63FF;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #5449FF;
    }

    textarea

    form h3 {
        color: #495057;
        margin-top: 20px;
    }

    form button {
        background-color: #6C63FF;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form input[type="text"],
    textarea,
    form input[type="password"],
    form input[type="number"] {
        width: 100%;
        padding: 8px;
        margin: 5px 0 15px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form input[type="submit"] {
        background-color: #6C63FF;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Стилі для блоків завдань */
    div:has(> h1) {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333333;
        border-bottom: 2px solid #A19AD3;
        padding-bottom: 10px;
        margin-top: 0;
    }

    /* Стилі для результатів */
    strong {
        color: #495057;
        display: inline-block;
        margin: 10px 0 5px;
    }

    p {
        margin: 10px 0;
        line-height: 1.5;
    }

    /* Стилі для списків */
    ul {
        list-style-type: none;
        padding: 0;
    }

    ul li {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }

    ul li:last-child {
        border-bottom: none;
    }

    /* Стилі для pre тегу */
    pre {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        white-space: pre-wrap;
        font-family: monospace;
        margin: 15px 0;
    }

    /* Стилі для таблиць */
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }

    td,
    th {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: center;
    }

    /* Додаткові стилі для виділення тексту */
    b,
    strong {
        color: #5449FF;
    }

    i {
        color: #6C63FF;
    }

    u {
        text-decoration-color: #A19AD3;
    }

    h3 {
        margin-top: 20px;
    }

    .form2_3 {
        display: none;
        position: fixed;
        width: 600px;
        top: 100px;
        left: calc(50% - 600px / 2);
        background-color: #A19AD3;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        font-family: 'Arial', sans-serif;
    }

    .form2_3 h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form2_3 input[type="email"],
    .form2_3 input[type="password"],
    .form2_3 select,
    .form2_3 textarea {
        width: 100%;
        padding: 10px;
        margin: 8px 0 20px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.9);
        box-sizing: border-box;
        font-size: 16px;
    }

    .form2_3 textarea {
        height: 100px;
        resize: vertical;
    }

    .form2_3 input[type="radio"],
    .form2_3 input[type="checkbox"] {
        margin-right: 8px;
        margin-bottom: 10px;
    }

    .form2_3 input[type="file"] {
        margin: 10px 0;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        color: rgb(0, 0, 0);
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    .form2_3 input[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #6C63FF;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .form2_3 input[type="submit"]:hover {
        background-color: #5449FF;
    }

    .form2_3 select {
        cursor: pointer;
    }

    .form2_3 label {
        color: #fff;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    /* Стилі для групи радіо-кнопок та чекбоксів */
    .form2_3 .radio-group,
    .form2_3 .checkbox-group {
        margin: 10px 0;
        color: #fff;
    }
</style>

<body>

    <header>
        <?= $Header ?? '' ?>
        <!-- <?= $Language ?? '' ?> -->
        <p><?= $languageText ?></p>
        <?php foreach ($languages as $code => $info): ?>
            <a href="index.php?lang=<?= $code ?>" class="btn">
                <img src="<?= $info['flag'] ?>" alt="<?= $info['name'] ?>" width="20">
            </a>
        <?php endforeach; ?>

    </header>

    <form action="template/profile.php" method="post" enctype="multipart/form-data" class="form2_3">
        <h2>Форма реєстрації</h2>
        Логін: <input type="email" name="login" value="<?= htmlspecialchars($login) ?>"><br>
        Пароль: <input type="password" name="password" required><br>
        Пароль (ще раз): <input type="password" name="confirm_password" required><br>

        Стать:
        <input type="radio" name="gender" value="male" <?= ($gender == 'male') ? 'checked' : '' ?>> чоловік
        <input type="radio" name="gender" value="female" <?= ($gender == 'female') ? 'checked' : '' ?>> жінка<br>

        Місто:
        <select name="city">
            <option value="Житомир" <?= ($city == 'Житомир') ? 'selected' : '' ?>>Житомир</option>
            <option value="Київ" <?= ($city == 'Київ') ? 'selected' : '' ?>>Київ</option>
            <option value="Львів" <?= ($city == 'Львів') ? 'selected' : '' ?>>Львів</option>
        </select><br>

        Улюблені ігри:<br>
        <input type="checkbox" name="games[]" value="футбол" <?= in_array('футбол', $games) ? 'checked' : '' ?>>
        футбол<br>
        <input type="checkbox" name="games[]" value="баскетбол" <?= in_array('баскетбол', $games) ? 'checked' : '' ?>>
        баскетбол<br>
        <input type="checkbox" name="games[]" value="шахи" <?= in_array('шахи', $games) ? 'checked' : '' ?>> шахи<br>

        Про себе:<br>
        <textarea name="about"><?= htmlspecialchars($about) ?></textarea><br>

        Фотографія: <input type="file" name="photo"><br>

        <input type="submit" value="Зареєструватися">
    </form>

    <div>
        <h1>Task1</h1>
        <p><?= $task1 ?? 'Завдання відсутне' ?></p>
    </div>
    <div>
        <h1>Task2</h1>
        <p><?= $task2 ?? 'Завдання відсутне' ?></p>
    </div>
    <div>
        <h1>Task3</h1>
        <p><?= $task3 ?? 'Завдання відсутне' ?></p>
    </div>
    <div>
        <h1>Task4</h1>
        <p><?= $task4 ?? 'Завдання відсутне' ?></p>
    </div>
    <div>
        <h1>Task5</h1>
        <p><?= $task5 ?? 'Завдання відсутне' ?></p>
    </div>
    <div>
        <h1>Task6</h1>
        <p><?= $task6 ?? 'Завдання відсутне' ?></p>
    </div>
    <script>
        function toggleform() {
            let form = document.querySelector('.form2_3');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>

</html>