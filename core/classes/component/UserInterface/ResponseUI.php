<?php


namespace DarlingDataManagementSystem\classes\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\UserInterface\ResponseUI as ResponseUIBase;
use DarlingDataManagementSystem\interfaces\component\UserInterface\ResponseUI as ResponseUIInterface;

class ResponseUI extends ResponseUIBase implements ResponseUIInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ResponseUIBase class
     * fulfills the requirements of the ResponseUIInterface.
     */
}