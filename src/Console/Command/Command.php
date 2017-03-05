<?php
namespace Parking\Console\Command;
/**
 * Interface Command
 *
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 * @package Parking\Console\Command
 */
interface Command
{

    /**
     * @param $input
     * @param $output
     * @return mixed
     */
    public function execute($input, $output);

}