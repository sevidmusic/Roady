<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\SwitchableComponent as SwitchableComponentInterface;

/**
 * Class SwitchableComponent. Defines an abstract implementation
 * of the SwitchableComponent interface that also extends the
 * StorableComponent abstract aggregate class. This class can be
 * implemented to define niche switchable components that can
 * be stored in a "container" at a "location".
 * @package DarlingCms\abstractions\aggregate
 * @see SwitchableComponent
 * @see SwitchableComponent::getName()
 * @see SwitchableComponent::getUid()
 * @see SwitchableComponent::getType()
 * @see SwitchableComponent::getLocation()
 * @see SwitchableComponent::getContainer()
 * @see SwitchableComponent::getState()
 * @see SwitchableComponent::switchState()
 */
class SwitchableComponent extends StorableComponent implements SwitchableComponentInterface
{
    /**
     * @var bool The currently assigned state.
     */
    protected $state;

    /**
     * SwitchableComponent constructor. Assigns the specified name,
     * type, location, container, and initial state, and assigns
     * an internally generated unique id.
     * @param string $name
     * @param string $type
     * @param string $location
     * @param string $container
     * @param bool $initialState
     */
    public function __construct(string $name, string $type, string $location, string $container, bool $initialState = false)
    {
        parent::__construct($name, $type, $location, $container);
        $this->state = $initialState;
    }

    /**
     * Returns the currently assigned state.
     * @return bool The currently assigned state.
     */
    public function getState(): bool
    {
        return $this->state;
    }

    /**
     * Switches the currently assigned state to it's opposite.
     * This will always be either a switch from true to false
     * or a switch from false to true.
     * @return bool True if the currently assigned state was
     *              switched successfully, false otherwise.
     */
    public function switchState(): bool
    {
        $initialState = $this->state;
        $this->state = ($this->state === false ? true : false);
        return ($this->state !== $initialState);
    }

}
