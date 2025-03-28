<?php
include 'db.php';
ob_start();
$st = 404; 

$ip = $_SERVER['REMOTE_ADDR'];
$url = $_SERVER['REQUEST_URI'];
http_response_code($st);
$status = $st;
$time = time();

$pdo->exec("INSERT INTO trafficuser (ip, url, status, time) VALUES ('$ip', '$url', $status, $time)");

echo "<h1>Записано в лог!</h1>";

ob_end_flush();
?>
