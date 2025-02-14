<?php
$task1 = '';
$task2 = '';
$task3 = '';
$task4 = '';
$task5 = '';
$task6 = '';
if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
    switch($lab){
        case 1:
            $Title = 'Lab_1';
            //$result = 'done';
            include 'labs/Lab_1.php';
        break;
    }
    include 'template/main.php';
}

?>