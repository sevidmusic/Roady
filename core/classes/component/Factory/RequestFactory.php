<?php

namespace roady\classes\component\Factory;

use roady\abstractions\component\Factory\RequestFactory as CoreRequestFactory;
use roady\interfaces\component\Factory\RequestFactory as RequestFactoryInterface;

class RequestFactory extends CoreRequestFactory implements RequestFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the RequestFactoryBase class
     * fulfills the requirements of the RequestFactoryInterface.
     */
}