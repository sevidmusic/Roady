<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\StorableComponent as StorableComponentInterface;
use \ReflectionMethod;
/**
 * Class StorableComponent. Defines an abstract implementation of the
 * StorableComponent interface that can be implemented to define
 * niche storable components.
 * @package DarlingCms\abstractions\aggregate
 * @see StorableComponent
 * @see StorableComponent::getType()
 * @see StorableComponent::getName()
 * @see StorableComponent::getUniqueId()
 * @see StorableComponent::getExpectedConstructorArgumenNames()
 * @see StorableComponent::getExpectedConstructorArgumentTypes()
 * @see StorableComponent::getExpectedConstructorArgumentDefaults()
 * @see StorableComponent::getLocation()
 * @see StorableComponent::getContainer()
 */
abstract class StorableComponent extends Component implements StorableComponentInterface
{
    /**
     * @var string $location The assigned location.
     */
    private $location;

    /**
     * @var string $components The assinged container.
     */
    private $container;

    /**
     * StorableComponent constructor. Assigns the name,
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
     * Returns the assigned storage location.
     * @return string The assigned storage location.
     */
    public function getLocation():string {
        return $this->location;
    }

     /**
     * Returns the assigned storage container.
     * @return string The assigned storage container.
     */
    public function getContainer():string {
        return $this->container;
    }

    /**
     * Returns an array of valid default constructor argument
     * values for implementations of this class that do
     * not implement their own __construct() method.
     * Note: Implementations that implement their own __construct()
     *       method MUST implement their own
     *       getDefaultConstructorArgumentValues()
     *       method and explicitly define appropriate
     *       default values in the array returned by
     *       the implementation's
     *       getDefaultConstructorArgumentValues()
     *       method.
     */
    protected function getDefaultConstructorArgumentValues() : array {
        return array('DefaultName', 'DefaultLocation', 'DefaultContainer');
    }
}
