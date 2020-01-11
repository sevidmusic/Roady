<?php

namespace DarlingCms\interfaces\component;

interface OutputComponent extends SwitchableComponent
{

    public function getOutput(): string;

}