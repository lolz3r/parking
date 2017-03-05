<?php
namespace Parking\Domain;

class Slot
{

    /**
     * @var null|Car
     */
    private $car;

    /**
     * Slot constructor.
     * @param Car|null $car
     */
    public function __construct(Car $car = null)
    {
        $this->car = $car;
    }


    /**
     *
     * @return bool
     */
    public function available()
    {
        return empty ($this->car);
    }

    public function leave()
    {
        $this->car = null;
    }

    /**
     * @param Car $car
     */
    public function addCar(Car $car)
    {
        $this->car = $car;
    }

    public function getCar()
    {
        return $this->car;
    }

}