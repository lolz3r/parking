<?php
namespace Parking\Console\Command;
/**
 * Class LeaveTest
 *
 * @author Rafael F Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
class LeaveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * parking leave
     */
    public function testExecuteWithoutParams()
    {
        $this->setExpectedException('Exception', 'You need pass a slot for leave');

        $handler = $this->generateHandler();
        $handler->dispatch();
    }

    /**
     * parking leave lorem-ipsum
     */
    public function testExecuteWithWrongParams()
    {
        $this->setExpectedException('Exception', 'You need pass a integer more than 0 for leave');

        $handler = $this->generateHandler(['lorem-ipsum']);
        $handler->dispatch();
    }

    /**
     * parking leave 4
     */
    public function testExecute()
    {
        $handler  = $this->generateHandler([4]);
        $response = $handler->dispatch();

        $this->assertEquals('Slot number 4 is free', $response);
    }


    /**
     * @param array $params
     * @return Handler
     */
    protected function generateHandler($params = [])
    {
        $handler = new \Parking\Console\Handler($this->generateArgv($params));

        $repository = new \Parking\Infrastructure\Repository\ParkingRepository(__DIR__ . "/../../../tmp/data");
        $handler->addCommand(new \Parking\Console\Command\Leave($repository));

        return $handler;
    }

    /**
     * @param array $params
     * @return array
     */
    protected function generateArgv($params = [])
    {
        return array_merge(['parking', 'leave'], $params);
    }

}
