<?php
namespace Parking\Console\Command;
/**
 * Class SlotNumbersForCarsWithColour
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class SlotNumbersForCarsWithColour implements Command
{

    /**
     * @var \Parking\Domain\Repository\ParkingRepository
     */
    private $repository;

    /**
     * SlotNumbersForCarsWithColour constructor.
     * @param \Parking\Domain\Repository\ParkingRepository $repository
     */
    public function __construct(\Parking\Domain\Repository\ParkingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute method
     *
     * @param $input
     * @param $output
     * @return string
     */
    public function execute($input, $output)
    {
        $this->validate($input);

        $keys = $this->repository->getSlotKeysForCarsWithColour($input[0]);
        $output = implode(', ', $keys);

        return $output;
    }

    /**
     * Validate method
     *
     * @param $input
     * @throws \Exception
     */
    protected function validate($input)
    {
        if (!isset($input[0])) {
            throw new \Exception('You need pass a colour');
        }
    }

}