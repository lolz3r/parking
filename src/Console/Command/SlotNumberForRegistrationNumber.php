<?php
namespace Parking\Console\Command;
/**
 * Class SlotNumberForRegistrationNumber
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class SlotNumberForRegistrationNumber implements Command
{

    /**
     * @var \Parking\Domain\Repository\ParkingRepository
     */
    private $repository;

    /**
     * SlotNumberForRegistrationNumber constructor.
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

        $key = $this->repository->getSlotKeyForCarWithPlate($input[0]);
        $output = $key ? $key : "Not found";
        
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
            throw new \Exception('You need pass a registration number');
        }
    }

}