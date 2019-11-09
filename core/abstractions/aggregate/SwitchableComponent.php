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
abstract class SwitchableComponent extends Component implements SwitchableComponentInterface
{
    private $location;

    private $container;

    /**
     * SwitchableComponent constructor. Assigns the name,
     * location, and container.
     * @param string $name The name to assign.
     * @param string $location The location to assign.
     * @param string $container The container to assign.
     */
    public function __construct(string $name, string $location, string $container)
    {
        parent::__construct($name);
        $this->location = $location;
        $this->container = $container;
    }

    /**
     * Return's the assigned location string.
     */
    public function getLocation():string {
        return $this->location;
    }

    /**
     * Returns the assigned container string.
     */
    public function getContainer():string {
        return $this->container;
    }

}
