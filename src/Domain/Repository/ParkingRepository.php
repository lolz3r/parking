<?php
namespace Parking\Domain\Repository;
/**
 * Interface ParkingRepository
 * @package Parking\Domain\Repository
 */
interface ParkingRepository
{

    public function get();

    public function store(\Parking\Domain\Parking $parking);

}