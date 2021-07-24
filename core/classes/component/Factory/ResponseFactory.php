<?php

namespace roady\classes\component\Factory;

use roady\abstractions\component\Factory\ResponseFactory as CoreResponseFactory;
use roady\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;

class ResponseFactory extends CoreResponseFactory implements ResponseFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ResponseFactoryBase class
     * fulfills the requirements of the ResponseFactoryInterface.
     */
}