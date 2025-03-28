<?php
namespace Models;

class FileManager {
    private static $dir = __DIR__ . "/text/";

    public static function writeToFile($filename, $content) {
        file_put_contents(self::$dir . $filename, $content . PHP_EOL, FILE_APPEND);
    }

    public static function readFromFile($filename) {
        return file_exists(self::$dir . $filename) ? file_get_contents(self::$dir . $filename) : "Файл не знайдено.";
    }

    public static function clearFile($filename) {
        file_put_contents(self::$dir . $filename, "");
    }
}
?>
