<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class SwitchableComponent extends Component implements SwitchableComponentInterface
{

    private $switchable;

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable);
        $this->setSwitchable($switchable);
    }

    private function setSwitchable(Switchable $switchable)
    {
        $this->switchable = $switchable;
    }

    public function getState(): bool
    {
        return $this->getSwitchable()->getState();
    }

    private function getSwitchable(): Switchable
    {
        return $this->switchable;
    }

    public function switchState(): bool
    {
        return $this->getSwitchable()->switchState();
    }

}