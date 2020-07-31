<?php

namespace DarlingDataManagementSystem\classes\component\Factory;

use DarlingDataManagementSystem\abstractions\component\Factory\StandardUITemplateFactory as CoreStandardUITemplateFactory;
use DarlingDataManagementSystem\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;

class StandardUITemplateFactory extends CoreStandardUITemplateFactory implements StandardUITemplateFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StandardUITemplateFactoryBase class
     * fulfills the requirements of the StandardUITemplateFactoryInterface.
     */
}