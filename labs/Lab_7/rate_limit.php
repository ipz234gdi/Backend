<?php
ob_start();

$ip = $_SERVER['REMOTE_ADDR'];
$logFile = __DIR__ . '/requests.log';
$time = time();
$limit = 5;
$interval = 60;

$lines = file_exists($logFile) ? file($logFile) : [];
$filtered = [];

foreach ($lines as $line) {
    list($logIp, $logTime) = explode(',', trim($line));
    if ($logIp === $ip && ($time - $logTime) <= $interval) {
        $filtered[] = $line;
    }
}

if (count($filtered) >= $limit) {
    http_response_code(429);
    echo "429 Too Many Requests. Спробуйте пізніше.";
} else {
    $filtered[] = "$ip,$time\n";
    file_put_contents($logFile, $filtered);
    http_response_code(200);
    echo "Запит прийнято!";
}

ob_end_flush();
?>
