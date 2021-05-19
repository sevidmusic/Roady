<?php


namespace DarlingDataManagementSystem\classes\component\UserInterface;

use DarlingDataManagementSystem\abstractions\component\UserInterface\WebUI as WebUIBase;
use DarlingDataManagementSystem\interfaces\component\UserInterface\WebUI as WebUIInterface;

class WebUI extends WebUIBase implements WebUIInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the WebUIBase class
     * fulfills the requirements of the WebUIInterface.
     */
}
