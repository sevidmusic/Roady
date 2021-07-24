<?php


namespace roady\classes\component\UserInterface;

use roady\abstractions\component\UserInterface\ResponseUI as ResponseUIBase;
use roady\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;

class ResponseUI extends ResponseUIBase implements ResponseUIInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ResponseUIBase class
     * fulfills the requirements of the ResponseUIInterface.
     */
}