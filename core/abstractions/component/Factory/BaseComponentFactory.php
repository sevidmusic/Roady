<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\classes\component\Action as CoreAction;
use DarlingCms\classes\component\Component as CoreComponent;
use DarlingCms\classes\component\OutputComponent as CoreOutputComponent;
use DarlingCms\classes\component\SwitchableComponent as CoreSwitchableComponent;
use DarlingCms\interfaces\component\Action;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Factory\BaseComponentFactory as BaseComponentFactoryInterface;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\component\Web\App;

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
