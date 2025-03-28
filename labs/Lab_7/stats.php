<?php
include 'db.php';
$dayAgo = time() - 86400;

$stmtTotal = $pdo->query("SELECT COUNT(*) FROM trafficuser WHERE time > $dayAgo");
$resTotal = $stmtTotal->fetchColumn();

$stmt404 = $pdo->query("SELECT COUNT(*) FROM trafficuser WHERE status = 404 AND time > $dayAgo");
$res404 = $stmt404->fetchColumn();

$percent = ($resTotal > 0) ? ($res404 / $resTotal * 100) : 0;

echo "404 за добу: $res404<br>";
echo "Всього: $resTotal<br>";
echo "Відсоток: " . round($percent, 2) . "%<br>";

if ($percent > 10) {
    echo "Попередження: більше 10% запитів завершуються 404!";
    // $to = "ipz234_gdi@student.ztu.edu.ua";
    // $subject = "Попередження: багато 404!";
    // $message = "Привіт!\nЗа останню добу понад 10% запитів завершились з кодом 404.";
    // $headers = "From: monitor@yourdomain.com\r\n" .
    //     "Content-Type: text/plain; charset=UTF-8";

    // mail($to, $subject, $message, $headers);
}
?>