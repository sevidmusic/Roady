<?php


namespace DarlingCms\classes\component\Factory;

use DarlingCms\interfaces\component\Factory\BaseComponentFactory as BaseComponentFactoryInterface;
use DarlingCms\abstractions\component\Factory\BaseComponentFactory as BaseComponentFactoryBase;

class BaseComponentFactory extends BaseComponentFactoryBase implements BaseComponentFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the BaseComponentFactoryBase class
     * fulfills the requirements of the BaseComponentFactoryInterface.
     */
}