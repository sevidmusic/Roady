<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\component\OutputComponent as OutputComponentInterface;

abstract class OutputComponent extends SwitchableComponent implements OutputComponentInterface
{

    private $output = '';


    public function getOutput(): string
    {
        return $this->output;
    }

}
