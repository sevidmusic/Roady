<?php

namespace DarlingDataManagementSystem\classes\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\RequestFactory as CoreRequestFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;

class RequestFactory extends CoreRequestFactory implements RequestFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the RequestFactoryBase class
     * fulfills the requirements of the RequestFactoryInterface.
     */
}