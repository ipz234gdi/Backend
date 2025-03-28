<?php
require_once "autoload.php";

use Models\Circle;
use Views\UserView;
use Models\FileManager;
use Models\Student;
use Models\Programmer;

// Завдання 1 - 4 створення користувача
$task1 = '<h3>Завдання 1 - 4: Створення користувача</h3>';
$view = new UserView('Денис', 'Грушевицький');
$task1 .= $view->render();

// Завдання 5 створення кола

$task2 = '<h3>Завдання 5: Створення кола</h3>';
$circle = new Circle(5, 10, 7);

$task2 .= "<p>{$circle}</p>";

// Перевірка методів
$circle->setX(8);
$circle->setY(12);
$circle->setRadius(10); // ЗАМІНИТИ В 6 ЗАВДАННІ НА 1 !!!

$task2 .= "<p>Оновлене: {$circle}</p>";

// Завдання 6
$circle2 = new Circle(15, 20, 5);

$task2 .= "<h3>Завдання 6: перетин кіл</h3>";
if ($circle->crossingCircle($circle2)) {
    $task2 .= "<p>Кола перетинаються</p>";
} else {
    $task2 .= "<p>Кола не перетинаються</p>";
}

// Завдання 7
$task3 = "<h3>Завдання 7: Робота з файлами</h3>";
// Пишемо у файл
FileManager::writeToFile("file1.txt", "Hello, World!");

// Читаємо з файлу
$task3 .= "<p>Файл містить: " . FileManager::readFromFile("file1.txt") . "</p>";

// Очищуємо файл
FileManager::clearFile("file1.txt");
$task3 .= "<p>Після очищення: " . FileManager::readFromFile("file1.txt") . "</p>";


// Завдання 8

$student = new Student(180, 70, 20, "КНУ", 2);
$student->levelUp();

$programmer = new Programmer(175, 68, 25, 5);
$programmer->addLanguage("PHP");
$programmer->addLanguage("JavaScript");

$task4 = "<h3>Завдання 8: Робота наслідуваними класами</h3>";
$task4 .= "<p>Студент вчиться у: " . $student->getUniversity() . ", курс: " . $student->getCourse() . "</p>";
$task4 .= "<p>Студенту - " . $student->getAge() . " " . "років</p>";
$task4 .= "<p>Програмісту " . $programmer->getAge() . " " . "років та має " . $programmer->getExperience() . " років досвіду і знає мови: " . implode(", ", $programmer->getLanguages()) . "</p>";

// Звадання 9 - 10
$task4 .= "<h3>Завдання 9: Робота з абстрактними класами </h3>";

// Виклик методу народження дитини
$task4 .= "<p>Народження студента: " . $student->addChild() . "</p>";
$task4 .= "<p>Народження програміста: " . $programmer->addChild() . "</p>";

$task4 .= "<h3>Завдання 10: Інтерфейси</h3>";

// Виклик методів прибирання
$task4 .= "<p>" . $student->cleanRoom() . " " . $student->cleanKitchen() . "</p>";
$task4 .= "<p>" . $programmer->cleanRoom() . " " . $programmer->cleanKitchen() . "</p>";
?>
