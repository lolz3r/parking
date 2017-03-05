<?php
namespace Parking\Console;

class Handler
{

    /**
     * @var $argv
     */
    private $argv;

    /**
     * @var
     */
    private $command;

    /**
     *
     * @var array
     */
    private $commands = [];

    /**
     * @var array
     */
    private $input = [];

    /**
     * @var string
     */
    private $output;

    public function __construct($argv)
    {
        $this->argv = $argv;
    }

    public function addCommand(\Parking\Console\Command\Command $command)
    {
        $this->commands[] = $command;
    }

    public function dispatch()
    {
        $this->parseCommand();
        $this->parseInput();
        $this->executeCommand();
        $this->renderCommand();

        return $this->output;
    }

    public function executeCommand()
    {
        $this->output = $this->command->execute($this->input, $this->output);
    }

    public function parseCommand()
    {
        $className = isset($this->argv[1]) ? $this->argv[1] : get_class($this->commands[0]);
        $className = $this->parseClassName($className);

        $command = $this->getCommand($className);
        if (!$command) {
            throw new \Exception('Command not found');
        }

        $this->command = $command;
    }

    protected function parseClassName($name)
    {
        return "Parking\\Console\\Command\\" . implode('', array_map('ucwords', explode('_', $name)));
    }

    protected function parseInput()
    {
        $this->input = array_slice($this->argv, 2);
    }

    protected function getCommand($name)
    {
        foreach ($this->commands as $command) {
            if ($name === get_class($command)) {
                return $command;
            }
        }

        return false;
    }

    public function renderCommand()
    {
        fwrite(STDOUT, $this->output . PHP_EOL);
    }
}