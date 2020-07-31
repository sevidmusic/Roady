<?php

namespace DarlingDataManagementSystem\abstractions\component\Factory;

use DarlingDataManagementSystem\classes\component\Action as CoreAction;
use DarlingDataManagementSystem\classes\component\Component as CoreComponent;
use DarlingDataManagementSystem\classes\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\classes\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Action;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\Factory\BaseComponentFactory as BaseComponentFactoryInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Web\App;

abstract class BaseComponentFactory extends PrimaryFactory implements BaseComponentFactoryInterface
{

    private $componentCrud;

    public function __construct(App $app, ComponentCrud $componentCrud)
    {
        $this->componentCrud = $componentCrud;
        parent::__construct($app);
    }


    public function buildComponent(string $name, string $container): Component
    {
        $component = new CoreComponent(
            $this->buildStorable($name, $container)
        );
        $this->componentCrud->create($component);
        return $component;
    }

    public function buildSwitchableComponent(string $name, string $container): SwitchableComponent
    {
        $switchableComponent = new CoreSwitchableComponent(
            $this->buildStorable($name, $container),
            $this->buildSwitchable()
        );
        $this->componentCrud->create($switchableComponent);
        return $switchableComponent;
    }

    public function buildOutputComponent(string $name, string $container, string $output, float $initialPosition): OutputComponent
    {
        $outputComponent = new CoreOutputComponent(
            $this->buildStorable($name, $container),
            $this->buildSwitchable(),
            $this->buildPositionable($initialPosition)
        );
        $outputComponent->import(['output' => $output]);
        $this->componentCrud->create($outputComponent);
        return $outputComponent;
    }

    public function buildAction(string $name, string $container, float $initialPosition): Action
    {
        $action = new CoreAction(
            $this->buildStorable($name, $container),
            $this->buildSwitchable(),
            $this->buildPositionable($initialPosition)
        );
        $this->componentCrud->create($action);
        return $action;
    }
}
