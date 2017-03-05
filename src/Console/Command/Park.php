<?php
namespace Parking\Console\Command;
/**
 * Class Park
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class Park implements Command
{

    /**
     * @var \Parking\Domain\Repository\ParkingRepository
     */
    private $repository;

    /**
     * Park constructor.
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

        $parking = $this->repository->get();
        $slot = $parking->park(new \Parking\Domain\Car($input[0], $input[1]));
        $this->repository->store($parking);

        if ($slot !== false) {
            $output = "Allocated slot number: " . $slot;
        }

        return $output ? $output : "Sorry, parking lot is full";
    }

    /**
     * Validate method
     *
     * @param $input
     * @throws \Exception
     */
    protected function validate($input)
    {
        if (count ($input) < 2) {
            throw new \Exception('You need pass a plate and colour for park');
        }
    }
}