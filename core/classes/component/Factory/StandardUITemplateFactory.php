<?php

namespace DarlingCms\classes\component\Factory;

use DarlingCms\interfaces\component\Factory\StandardUITemplateFactory as StandardUITemplateFactoryInterface;
use DarlingCms\abstractions\component\Factory\StandardUITemplateFactory as CoreStandardUITemplateFactory;

class StandardUITemplateFactory extends CoreStandardUITemplateFactory implements StandardUITemplateFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StandardUITemplateFactoryBase class
     * fulfills the requirements of the StandardUITemplateFactoryInterface.
     */
}