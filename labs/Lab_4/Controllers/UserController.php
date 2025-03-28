<?php
namespace Controllers;
use Models\UserModel;

class UserController {
    private $model;

    public function __construct($firstname, $lastname) {
        $this->model = new UserModel($firstname, $lastname);
    }

    public function showUser() {
        return $this->model->getUser();
    }
}
?>
