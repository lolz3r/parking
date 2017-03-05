<?php
namespace Parking\Console\Command;
/**
 * Class ParkTest
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class ParkTest extends \PHPUnit_Framework_TestCase
{

    /**
     * parking create_parking_lot
     */
    public function testExecuteWithoutParams()
    {
        $this->setExpectedException('Exception', 'You need pass a plate and colour for park');

        $handler = $this->generateHandler();
        $handler->dispatch();
    }

    /**
     * parking create_parking_lot KA­01­HH­1234
     */
    public function testExecuteWithOneParam()
    {

        $this->setExpectedException('Exception', 'You need pass a plate and colour for park');

        $handler = $this->generateHandler(['KA­01­HH­1234']);
        $handler->dispatch();
    }

    /**
     * parking create_parking_lot KA­01­HH­1234 White
     */
    public function testExecute()
    {
        $handler  = $this->generateHandler(['KA­01­HH­1234', 'White']);
        $response = $handler->dispatch();

        $this->assertEquals('Allocated slot number:', substr($response, 0, 22));
    }

    /**
     * @param array $params
     * @return Handler
     */
    protected function generateHandler($params = [])
    {
        $handler = new \Parking\Console\Handler($this->generateArgv($params));

        $repository = new \Parking\Infrastructure\Repository\ParkingRepository(__DIR__ . "/../../../tmp/data");
        $handler->addCommand(new \Parking\Console\Command\Park($repository));

        return $handler;
    }

    /**
     * @param array $params
     * @return array
     */
    protected function generateArgv($params = [])
    {
        return array_merge(['parking', 'park'], $params);
    }

}