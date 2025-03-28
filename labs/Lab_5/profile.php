<?php
session_start();
require_once 'db.php'; // Підключення до бази

if(!isset($_SESSION['user_id'])){
    header("Location: ../../index.php?lab=5");
    exit;
}

$user_id = $_SESSION['user_id'];

// Завантажуємо поточні дані користувача
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Збираємо дані з форми
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $age        = (int) $_POST['age'];
    $phone      = trim($_POST['phone']);
    $address    = trim($_POST['address']);
    
    // Якщо користувач ввів пароль – хешуємо, інакше лишаємо старий
    if(!empty($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $password = $user['password']; // старий пароль
    }
    
    // Оновлюємо всі поля в таблиці
    $stmt = $pdo->prepare("
        UPDATE users 
        SET username   = ?, 
            email      = ?, 
            password   = ?, 
            first_name = ?, 
            last_name  = ?, 
            age        = ?, 
            phone      = ?, 
            address    = ?
        WHERE id = ?
    ");
    
    if($stmt->execute([
        $username, 
        $email, 
        $password, 
        $first_name, 
        $last_name, 
        $age, 
        $phone, 
        $address, 
        $user_id
    ])){
        // Оновлюємо дані в сесії (щоб логін в хедері чи десь ще також змінився)
        $_SESSION['username'] = $username;
        $success = "Дані оновлено!";
        
        // Заново вибираємо оновлені дані, щоб форма теж була актуальною
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
    } else {
        $error = "Помилка оновлення!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Редагування профілю</title>
</head>
<style>
    body {
    font-family: 'Roboto', Arial, sans-serif;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    color: #333;
}

h2 {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

form {
    background-color: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 15px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

p {
    margin: 15px 0;
}

a {
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s;
}

a:hover {
    color: #2980b9;
    text-decoration: underline;
}

.delete-link {
    color: #e74c3c;
}

.delete-link:hover {
    color: #c0392b;
}

.success-message {
    color: #27ae60;
    background-color: #e8f8f2;
    padding: 10px;
    border-left: 4px solid #27ae60;
    margin-bottom: 20px;
}

.error-message {
    color: #e74c3c;
    background-color: #fde9e7;
    padding: 10px;
    border-left: 4px solid #e74c3c;
    margin-bottom: 20px;
}
</style>
<body>
  <h2>Привіт, <?php echo htmlspecialchars($_SESSION['username']); ?>! Змінюй свої дані, не соромся:</h2>
  
  <?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  
  <form method="post" action="">
    <p>
      Логін: 
      <input type="text" name="username" 
             value="<?php echo htmlspecialchars($user['username']); ?>">
    </p>
    <p>
      Email: 
      <input type="email" name="email" 
             value="<?php echo htmlspecialchars($user['email']); ?>">
    </p>
    <p>
      Пароль (заповніть, щоб змінити!):
      <input type="password" name="password" value="">
    </p>
    <p>
      Ім'я:
      <input type="text" name="first_name" 
             value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>">
    </p>
    <p>
      Прізвище:
      <input type="text" name="last_name" 
             value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>">
    </p>
    <p>
      Вік:
      <input type="number" name="age" 
             value="<?php echo htmlspecialchars($user['age'] ?? ''); ?>">
    </p>
    <p>
      Телефон:
      <input type="text" name="phone" 
             value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
    </p>
    <p>
      Адреса:
      <input type="text" name="address" 
             value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
    </p>
    
    <input type="submit" value="Оновити">
  </form>
  
  <p><a href="delete_account.php">Видалити профіль</a></p>
  <p><a href="../../index.php?lab=5">На головну</a></p>
</body>
</html>
