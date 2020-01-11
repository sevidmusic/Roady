<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\component\OutputComponent as OutputComponentInterface;

abstract class OutputComponent extends SwitchableComponent implements OutputComponentInterface
{

    public function getOutput(): string
    {
        return '';
    }

}