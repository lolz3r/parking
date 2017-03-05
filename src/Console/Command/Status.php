<?php
namespace Parking\Console\Command;
/**
 * Class Status
 * @package Parking\Console\Command
 */
class Status implements Command
{
    private $repository;

    public function __construct(\Parking\Domain\Repository\ParkingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($input, $output)
    {
        $parking = $this->repository->get();

        $columns = "|%5.5s |%-20.20s | %-10.10s |\n";
        $output = sprintf($columns, 'Slot No.', 'Registration No', 'Colour');
        foreach ($parking->getSlots() as $key => $slot)
        {
            $plate  = $slot->getCar() ? $slot->getCar()->plate : '';
            $colour = $slot->getCar() ? $slot->getCar()->colour : '';

            $output .= sprintf($columns, $key + 1, $plate, $colour);
        }

        return $output;
    }


}