<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\SwitchableComponent as SwitchableComponentInterface;
use \ReflectionMethod;
/**
 * Class SwitchableComponent. Defines an abstract implementation of the
 * SwitchableComponent interface that can be implemented to define
 * niche switchable components.
 * @package DarlingCms\abstractions\aggregate
 * @see SwitchableComponent
 * @see SwitchableComponent::getType()
 * @see SwitchableComponent::getName()
 * @see SwitchableComponent::getUniqueId()
 */
abstract class SwitchableComponent extends StorableComponent implements SwitchableComponentInterface
{

    /**
     * @var bool $state Boolean that indicates that component's state,
     *                  true for on, false for off.
     */
    private $state;

    /**
     * SwitchableComponent constructor. Assigns the name, location, container,
     * and initial state.
     * @param string $name The name to assign.
     * @param string $location The location to assign.
     * @param string $container The container to assign.
     * @param bool $initialState The initial state, true for on, false for off.
     */
    public function __construct(string $name, string $location, string $container, bool $initialState)
    {
        parent::__construct($name, $location, $container);
        $this->state = $initialState;
    }

     /**
     * Returns the state of the switch represented as a boolean value,
     * true for on, false for off.
     * @return bool The state of the switch represented as a boolean value,
     *              true for on, false for off.
     */
    public function getState(): bool {
        return $this->state;
    }

    /**
     * Switches the state, either from true to false, or false to
     * true. This method will return true if state was switched,
     * false otherwise.
     *
     * @return bool True if state was switched, false otherwise.
     */
    public function switchState():bool {
        $initialState = $this->getState();
        $this->state = ($initialState === true ? false : true);
        return ($this->getState() !== $initialState);
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
        return array('DefaultName', 'DefaultLocation', 'DefaultContainer', false);
    }

}
