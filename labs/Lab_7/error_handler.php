<?php
ob_start();

function handleFatalError() {
    $error = error_get_last();
    if ($error && $error['type'] === E_ERROR) {
        ob_clean();
        http_response_code(500);
        echo "
        <style>
        body {
            padding: 0;
            margin: 0;
        }
        .status500 {
            display: flex;
            background-color:rgb(26, 26, 26);
            color:rgb(255, 105, 105);
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 0;
            margin: 0;
        }
        </style>
        <h1 class='status500'>500 Internal Server Error
        <p>Ми вже працюємо над вирішенням проблеми. Повторіть спробу пізніше.</p>
        </h1>";
    } else {
        http_response_code(200);
    }
}

register_shutdown_function('handleFatalError');

// non_existing_function(); // Розкоментуй для тесту

echo "<p>Все працює!</p>";

ob_end_flush();
?>
