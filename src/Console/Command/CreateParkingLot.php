<?php
namespace Parking\Console\Command;
/**
 * Class CreateParkingLot
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class CreateParkingLot implements Command
{

    /**
     * @var \Parking\Domain\Repository\ParkingRepository
     */
    private $repository;

    /**
     * CreateParkingLot constructor.
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

        $parking = new \Parking\Domain\Parking(array_map(function() {
            return new \Parking\Domain\Slot();
        }, range(1, $input[0])));

        $this->repository->store($parking);
        $output = "Created a parking lot with {$input[0]} slots";

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
        if (!$input) {
            throw new \Exception('You need pass a number of a slot');
        }
        if ($input[0] < 1) {
            throw new \Exception('You need pass a integer more than 0 for slot');
        }
    }

}
