<?php

namespace roady\classes\primary;

use roady\abstractions\primary\Exportable as ExportableBase;
use roady\interfaces\primary\Exportable as ExportableInterface;

class Exportable extends ExportableBase implements ExportableInterface
{

    /**
     * This is a generic implementation, it does not require
     * any additional logic, the ExportableBase class
     * fulfills the requirements of the ExportableInterface.
     */
}
