<?php
namespace Models;
use Interfaces\HouseCleaning;

class Programmer extends Human implements HouseCleaning {
    private $languages = [];
    private $experience;

    public function __construct($height, $weight, $age, $experience) {
        parent::__construct($height, $weight, $age);
        $this->experience = $experience;
    }

    public function getLanguages() { return $this->languages; }
    public function getExperience() { return $this->experience; }

    public function setLanguages($languages) { $this->languages = $languages; }
    public function setExperience($experience) { $this->experience = $experience; }

    public function addLanguage($language) {
        $this->languages[] = $language;
    }

    protected function birthMessage() {
        return "Новий програміст народився!<br>";
    }

    public function cleanRoom() {
        return "Програміст прибирає кімнату.<br>";
    }

    public function cleanKitchen() {
        return "Програміст прибирає кухню.<br>";
    }
}
?>
