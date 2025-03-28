<?php
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;
    $path = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";

    if (file_exists($path)) {
        require_once $path;
    } else {
        die("Не вдалося знайти файл для класу: $class (Очікуваний шлях: $path)");
    }
});
?>
