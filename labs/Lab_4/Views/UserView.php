<?php
namespace Views;
use Controllers\UserController;

class UserView {
    private $controller;

    public function __construct($firstname, $lastname) {
        $this->controller = new UserController($firstname, $lastname);
    }

    public function render() {
        return $this->controller->showUser();
    }
}
?>
