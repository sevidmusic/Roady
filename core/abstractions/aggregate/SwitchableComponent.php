<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\SwitchableComponent as SwitchableComponentInterface;
use \ReflectionMethod;
/**
 * Class SwitchableComponent. Defines an abstract implementation of the
 * SwitchableComponent interface that can be implemented to define
 * niche storable components.
 * @package DarlingCms\abstractions\aggregate
 * @see SwitchableComponent
 * @see SwitchableComponent::getType()
 * @see SwitchableComponent::getName()
 * @see SwitchableComponent::getUniqueId()
 */
abstract class SwitchableComponent extends StorableComponent implements SwitchableComponentInterface
{

    private $state;

    /**
     * SwitchableComponent constructor. Assigns the name,
     * location, and container.
     * @param string $name The name to assign.
     * @param string $location The location to assign.
     * @param string $container The container to assign.
     */
    public function __construct(string $name, string $location, string $container, bool $initialState)
    {
        parent::__construct($name, $location, $container);
        $this->state = $initialState;
    }

    public function getState(): bool {
        return $this->state;
    }

    public function switchState():bool {
        $initialState = $this->getState();
        $this->state = ($initialState === true ? false : true);
        return ($this->getState() !== $initialState);
    }

    public function getExpectedConstructorArgumentDefaults():array {
        return array_combine($this->getComponentConstructorParamerterInfo('n'), array('DefaultName', 'DefaultLocation', 'DefaultContainer', true));
    }
}
