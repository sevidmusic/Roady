<?php

namespace DarlingDataManagementSystem\classes\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\ResponseFactory as CoreResponseFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;

class ResponseFactory extends CoreResponseFactory implements ResponseFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ResponseFactoryBase class
     * fulfills the requirements of the ResponseFactoryInterface.
     */
}