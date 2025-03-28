<?php
include 'Response.php';

$response = new Response();
$response->setStatus(200);
$response->addHeader("Content-Type: text/html");
$response->send("<h1>Вітаємо!</h1><p>Це динамічна відповідь.</p>");

?>