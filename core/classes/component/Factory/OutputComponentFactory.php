<?php

namespace roady\classes\component\Factory;

use roady\abstractions\component\Factory\OutputComponentFactory as CoreOutputComponentFactory;
use roady\interfaces\component\Factory\OutputComponentFactory as OutputComponentFactoryInterface;

class OutputComponentFactory extends CoreOutputComponentFactory implements OutputComponentFactoryInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the OutputComponentFactoryBase class
     * fulfills the requirements of the OutputComponentFactoryInterface.
     */
}