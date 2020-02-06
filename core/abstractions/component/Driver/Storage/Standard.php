<?php

namespace DarlingCms\abstractions\component\Driver\Storage;

use DarlingCms\abstractions\component\Driver\Storage\FileSystem\Json as JsonStorageDriver;
use DarlingCms\interfaces\component\Driver\Storage\FileSystem\Json as JsonStorageDriverInterface;
use DarlingCms\interfaces\component\Driver\Storage\Standard as StandardInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class Standard extends JsonStorageDriver implements StandardInterface, JsonStorageDriverInterface
{

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

}
