<?php
namespace Parking\Domain;

class Car
{

    /**
     * @var
     */
    public $plate;

    /**
     * @var
     */
    public $colour;


    public function __construct($plate, $colour)
    {
        $this->plate = $plate;
        $this->colour = $colour;
    }
}