<?php


namespace roady\classes\component\Web\Routing;

use roady\abstractions\component\Web\Routing\Request as RequestBase;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;

class Request extends RequestBase implements RequestInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the RequestBase class
     * fulfills the requirements of the RequestInterface.
     */
}
