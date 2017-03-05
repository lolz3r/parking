<?php
namespace Parking\Domain;
/**
 * Class Parking
 * @package Parking\Domain
 */
class Parking
{

    /**
     * @var array
     */
    private $slots = [];

    /**
     * Parking constructor.
     * @param array $slots
     */
    public function __construct($slots = array())
    {
        $this->slots = $slots;
    }

    /**
     * Park method
     *
     * @param Car $car
     * @return bool|int
     */
    public function park(Car $car)
    {
        foreach ($this->slots as $index => &$slot) {
            if ($slot->available()) {
                $slot->addCar($car);
                return $index + 1;
            }
        }

        return false;
    }

    /**
     * Leave method
     *
     * @param $key
     * @return bool
     */
    public function leave($key)
    {
        $slot = $this->getSlot($key);
        if ($slot) {
            $slot->leave();
            return true;
        }

        return false;
    }

    /**
     * Getter of slot
     *
     * @param $key
     * @return bool|mixed
     */
    public function getSlot($key)
    {
        if (!isset ($this->slots[$key])) {
            return false;
        }

        return $this->slots[$key];
    }

    /**
     * Getter of slots
     *
     * @return array
     */
    public function getSlots()
    {
        return $this->slots;
    }


}