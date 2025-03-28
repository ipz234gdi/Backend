<?php
namespace Models;

class Circle {
    private $x;
    private $y;
    private $radius;

    public function __construct($x, $y, $radius) {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }

    public function getX() { return $this->x; }
    public function getY() { return $this->y; }
    public function getRadius() { return $this->radius; }

    public function setX($x) { $this->x = $x; }
    public function setY($y) { $this->y = $y; }
    public function setRadius($radius) { $this->radius = $radius; }

    public function __toString() {
        return "Коло з центром в ({$this->x}, {$this->y}) і радіусом {$this->radius}";
    }

    public function crossingCircle(Circle $other) {
        $distance = sqrt(pow($this->x - $other->getX(), 2) + pow($this->y - $other->getY(), 2));
        return $distance < ($this->radius + $other->getRadius());
    }
}
?>
