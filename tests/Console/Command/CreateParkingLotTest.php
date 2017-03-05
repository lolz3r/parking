<?php
namespace Parking\Console\Command;
/**
 * Class CreateParkingLotTest
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class CreateParkingLotTest extends \PHPUnit_Framework_TestCase
{

    /**
     * parking create_parking_lot
     */
    public function testExecuteWithoutParams()
    {
        $this->setExpectedException('Exception', 'You need pass a number of a slot');

        $handler = $this->generateHandler();
        $handler->dispatch();
    }

    /**
     * parking create_parking_lot lorem-ipsum
     */
    public function testExecuteWithWrongParams()
    {
        $this->setExpectedException('Exception', 'You need pass a integer more than 0 for slot');

        $handler = $this->generateHandler(['lorem-ipsum']);
        $handler->dispatch();
    }

    /**
     * parking create_parking_lot 6
     */
    public function testExecute()
    {
        $handler  = $this->generateHandler([6]);
        $response = $handler->dispatch();

        $this->assertEquals('Created a parking lot with 6 slots', $response);
    }

    /**
     * Generate Handler
     *
     * @param array $params
     * @return \Parking\Console\Handler
     */
    protected function generateHandler($params = [])
    {
        $handler = new \Parking\Console\Handler($this->generateArgv($params));

        $repository = new \Parking\Infrastructure\Repository\ParkingRepository(__DIR__ . "/../../../tmp/data");
        $handler->addCommand(new \Parking\Console\Command\CreateParkingLot($repository));

        return $handler;
    }

    /**
     * Generate Argv
     *
     * @param array $params
     * @return array
     */
    protected function generateArgv($params = [])
    {
        return array_merge(['parking', 'create_parking_lot'], $params);
    }
}
