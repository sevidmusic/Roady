<?php

namespace DarlingCms\abstractions\primary;

use DarlingCms\interfaces\primary\Exportable as ExportableInterface;

abstract class Exportable implements ExportableInterface  {
    public function export():array {
        return array();
    }

    public function import(array $export):bool {
        return true;
    }
}
