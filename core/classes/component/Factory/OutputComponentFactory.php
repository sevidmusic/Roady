<?php

namespace DarlingCms\classes\component\Factory;

use DarlingCms\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;
use DarlingCms\abstractions\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;

class OutputComponentFactory extends CoreOutputComponentFactory implements OutputComponentFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the OutputComponentFactoryBase class
     * fulfills the requirements of the OutputComponentFactoryInterface.
     */
}