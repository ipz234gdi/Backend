<?php
$cacheFile = __DIR__ . '/cache.html';
$status = 200;

http_response_code($status);

if ($status == 200 && file_exists($cacheFile)) {
    echo file_get_contents($cacheFile);
    exit;
}

ob_start();

if ($status == 200) {
    echo "<h1>Сторінка завантажена успішно!</h1>";
    file_put_contents($cacheFile, ob_get_contents());
} elseif ($status == 404) {
    echo "
    <style>
        body {
        padding: 0;
        margin: 0;
        }
        .status404 {
        display: flex;
        background-color:rgb(26, 26, 26);
        color:rgb(255, 105, 105);
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        padding: 0;
        margin: 0;
    }
    </style>
    <h1 class='status404'>Сторінка не знайдена!</h1>
    ";
    if (file_exists($cacheFile)) {
        unlink($cacheFile);
    }
}

ob_end_flush();
?>