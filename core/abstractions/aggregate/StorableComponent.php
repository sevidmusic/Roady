<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\StorableComponent as StorableComponentInterface;

/**
 * Class StorableComponent. Defines an abstract implementation
 * of the StorableComponent interface that also extends the
 * Component abstract aggregate class. This class can be
 * implemented to define niche storable components.
 * @package DarlingCms\abstractions\aggregate
 * @see StorableComponent
 * @see StorableComponent::getName()
 * @see StorableComponent::getUniqueId()
 * @see StorableComponent::getType()
 * @see StorableComponent::getLocation()
 * @see StorableComponent::getContainer()
 */
abstract class StorableComponent extends Component implements StorableComponentInterface
{
    /**
     * @var string The assigned location.
     */
    protected $location;

    /**
     * @var string The assigned container.
     */
    protected $container;

    /**
     * StorableComponent constructor. Assigns the specified name, type,
     * location, and container, and assigns an integrally generated unique
     * id.
     * @param string $name The name to assign.
     * @param string $type The type to assign.
     * @param string $location The location to assign.
     * @param string $container The container to assign.
     */
    public function __construct(string $name, string $type, string $location, string $container)
    {
        parent::__construct($name, $type);
        $this->location = trim($location);
        $this->container = trim($container);
    }

    /**
     * Returns the assigned location.
     * @return string The assinged location.
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * Returns the assigned container.
     * @return string The assigned container.
     */
    public function getContainer(): string
    {
        return $this->container;
    }

}
