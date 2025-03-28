<?php
ob_start();

$redirects = json_decode(file_get_contents("redirects.json"), true);
$request = $_SERVER['REQUEST_URI'];

if (isset($redirects[$request])) {
    $target = $redirects[$request];
    if ($target === "/404") {
        http_response_code(404);
        echo "<h1>Сторінка не знайдена!</h1>";
    } else {
        header("Location: $target", true, 301);
        exit;
    }
} else {
    http_response_code(200);
    echo "<h1>Ви1 на новій сторінці!</h1>";
}

ob_end_flush();
?>
