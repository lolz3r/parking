<?php
namespace Parking\Infrastructure\Repository;

class ParkingRepository implements \Parking\Domain\Repository\ParkingRepository
{

    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function get()
    {
        $data = file_get_contents($this->path);
        return $data ? unserialize($data) : new \Parking\Domain\Parking();
    }

    public function getSlotsForCarsWithColour($colour)
    {
        $parking = $this->get();
        $slots = array_filter($parking->getSlots(), function($slot) use ($colour) {
            return $slot->getCar() && $slot->getCar()->colour == $colour;
        });

        return $slots;
    }

    public function getPlateForCarsWithColour($colour)
    {
        $slots = $this->getSlotsForCarsWithColour($colour);
        $results = [];
        foreach ($slots as $slot) {
            $results[] = $slot->getCar()->plate;
        }

        return $results;
    }

    public function getSlotKeysForCarsWithColour($colour)
    {
        $parking = $this->get();
        $slots = $this->getSlotsForCarsWithColour($colour);

        $results = [];
        foreach ($slots as $slot) {
            $results[] = array_search($slot, $parking->getSlots()) + 1;
        }

        return $results;
    }

    public function getSlotKeyForCarWithPlate($plate)
    {
        $parking = $this->get();
        foreach ($parking->getSlots() as $index => $slot) {
            if ($slot->getCar() && $slot->getCar()->plate == $plate) {
                return $index + 1;
            }
        }

        return false;
    }

    public function store(\Parking\Domain\Parking $parking)
    {
        return file_put_contents($this->path, serialize($parking));
    }


}