<?php

namespace DarlingDataManagementSystem\abstractions\component\Driver\Storage;

use DarlingDataManagementSystem\abstractions\component\Driver\Storage\FileSystem\Json as JsonStorageDriver;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\FileSystem\Json as JsonStorageDriverInterface;
use DarlingDataManagementSystem\interfaces\component\Driver\Storage\Standard as StandardInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class Standard extends JsonStorageDriver implements StandardInterface, JsonStorageDriverInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
