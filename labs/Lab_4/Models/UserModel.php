<?php
namespace Models;

class UserModel {
    private $firstname;
    private $lastname;

    public function __construct($firstname = "Ім'я", $lastname = "Прізвище") {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
    public function getUser() {
        return "Користувач: {$this->firstname} {$this->lastname}";
    }
}
?>
