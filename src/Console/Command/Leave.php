<?php
namespace Parking\Console\Command;
use Parking\Domain\Repository\ParkingRepository;

/**
 * Class Leave
 *
 * @author Rafael F Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class Leave implements Command
{
    /**
     * @var ParkingRepository
     */
    private $repository;

    /**
     * Leave constructor.
     * @param ParkingRepository $repository
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

        $parking = $this->repository->get();
        $leave = $parking->leave($input[0] - 1);
        $this->repository->store($parking);

        if ($leave) {
            $output = "Slot number {$input[0]} is free";
        }

        return $output ? $output : "Not found";
    }

    /**
     * Validate method
     *
     * @param $input
     * @throws \Exception
     */
    protected function validate($input)
    {
        if (!$input) {
            throw new \Exception('You need pass a slot for leave');
        }
        if ($input[0] < 1) {
            throw new \Exception('You need pass a integer more than 0 for leave');
        }
    }
}