<?php


namespace roady\classes\component\Factory;

use roady\abstractions\component\Factory\PrimaryFactory as PrimaryFactoryBase;
use roady\interfaces\component\Factory\PrimaryFactory as PrimaryFactoryInterface;

class PrimaryFactory extends PrimaryFactoryBase implements PrimaryFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the PrimaryFactoryBase class
     * fulfills the requirements of the PrimaryFactoryInterface.
     */
}