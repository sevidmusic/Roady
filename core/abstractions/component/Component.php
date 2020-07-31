<?php


namespace DarlingDataManagementSystem\abstractions\component;


use DarlingDataManagementSystem\abstractions\primary\Exportable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable;

abstract class Component extends Exportable implements ComponentInterface
{

    private $storable;

    public function __construct(Storable $storable)
    {
        parent::__construct();
        $this->setStorable($storable);
    }

    private function setStorable(Storable $storable)
    {
        $this->storable = $storable;
    }

    public function getName(): string
    {
        return $this->getStorable()->getName();
    }

    private function getStorable(): Storable
    {
        return $this->storable;
    }

    public function getUniqueId(): string
    {
        return $this->getStorable()->getUniqueId();
    }

    public function getLocation(): string
    {
        return $this->getStorable()->getLocation();
    }

    public function getContainer(): string
    {
        return $this->getStorable()->getContainer();
    }
}