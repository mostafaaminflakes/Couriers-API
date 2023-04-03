<?php

namespace App\Repositories;

use App\Interfaces\CourierInterface;
use Exception;

class CourierGateway
{
    /**
     * Available couriers in the system.
     * [Expected to be generated from DB]
     */
    protected $gateways = ['smsa', 'dhl', 'ups', 'aramex', 'shipbox'];

    /**
     * Register a new courier within the service provider.
     */
    function register($name, CourierInterface $instance)
    {
        $this->gateways[$name] = $instance;
        return $this;
    }

    /**
     * Get a registered courier or throw an exception.
     */
    function get($name)
    {
        if (in_array($name, $this->gateways)) {
            return (object) $this->gateways[$name];
        } else {
            throw new Exception("Invalid gateway");
        }
    }
}
