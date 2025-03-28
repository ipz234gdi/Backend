<?php
namespace Models;
use Interfaces\HouseCleaning;

class Student extends Human implements HouseCleaning {
    private $university;
    private $course;

    public function __construct($height, $weight, $age, $university, $course) {
        parent::__construct($height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }

    public function getUniversity() { return $this->university; }
    public function getCourse() { return $this->course; }

    public function setUniversity($university) { $this->university = $university; }
    public function setCourse($course) { $this->course = $course; }

    public function levelUp() {
        $this->course++;
    }

    protected function birthMessage() {
        return "Новий студент народився!<br>";
    }

    public function cleanRoom() {
        return "Студент прибирає кімнату.<br>";
    }

    public function cleanKitchen() {
        return "Студент прибирає кухню.<br>";
    }
}
?>
