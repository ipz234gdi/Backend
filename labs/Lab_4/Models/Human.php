<?php
namespace Models;

abstract class Human {
    protected $height;
    protected $weight;
    protected $age;

    public function __construct($height, $weight, $age) {
        $this->height = $height;
        $this->weight = $weight;
        $this->age = $age;
    }

    public function getHeight() { return $this->height; }
    public function getWeight() { return $this->weight; }
    public function getAge() { return $this->age; }

    public function setHeight($height) { $this->height = $height; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setAge($age) { $this->age = $age; }

    public function addChild() {
        return $this->birthMessage();
    }

    protected abstract function birthMessage();
}
?>
