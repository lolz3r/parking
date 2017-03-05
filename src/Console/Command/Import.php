<?php
namespace Parking\Console\Command;

class Import implements Command
{

    public function execute($input, $output)
    {
        $this->validate($input);
        $commands = $this->parse($input);
        if (!$commands) {
            throw new \Exception("Commands not found");
        }

        $path = getcwd() . "/tmp/data";
        $repository = new \Parking\Infrastructure\Repository\ParkingRepository($path);
        foreach ($commands as $command) {
            $argv = $this->generateArgv($command);

            $handler = new \Parking\Console\Handler($argv);
            $handler->addCommand(new \Parking\Console\Command\CreateParkingLot($repository));
            $handler->addCommand(new \Parking\Console\Command\Leave($repository));
            $handler->addCommand(new \Parking\Console\Command\Park($repository));
            $handler->addCommand(new \Parking\Console\Command\RegistrationNumbersForCarsWithColour($repository));
            $handler->addCommand(new \Parking\Console\Command\SlotNumbersForCarsWithColour($repository));
            $handler->addCommand(new \Parking\Console\Command\SlotNumberForRegistrationNumber($repository));
            $handler->addCommand(new \Parking\Console\Command\Status($repository));

            $handler->dispatch();
        }
    }

    public function generateArgv($command)
    {
        return array_merge(['parking'], explode(' ', $command));
    }

    /**
     *
     * @param $input
     * @return array
     */
    protected function parse($input)
    {
        $fp = fopen($input[0], 'r');
        while ($command = fgets($fp, 4096)) {
            $commands[] = trim($command);
        }
        fclose($fp);

        return $commands;
    }

    /**
     * @param $input
     * @throws \Exception
     */
    protected function validate($input)
    {
        if (!isset ($input[0])) {
            throw new \Exception('Param required');
        }
        if (!is_file ($input[0])) {
            throw new \Exception('File invalid');
        }
    }
}