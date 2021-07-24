<?php

namespace roady\classes\component\Factory\App;

use roady\abstractions\component\Factory\App\AppComponentsFactory as CoreAppComponentsFactory;
use roady\interfaces\component\Factory\App\AppComponentsFactory as AppComponentsFactoryInterface;

class AppComponentsFactory extends CoreAppComponentsFactory implements AppComponentsFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the AppComponentsFactoryBase class
     * fulfills the requirements of the AppComponentsFactoryInterface.
     */
}