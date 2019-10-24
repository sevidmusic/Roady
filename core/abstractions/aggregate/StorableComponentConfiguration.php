<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\StorableComponentConfiguration as StorableComponentConfigurationInterface;

abstract class StorableComponentConfiguration extends StorableComponent implements StorableComponentConfigurationInterface
{

    protected $expectedConfigurationKeys = array();

    protected $configuration = array();


    /**
     * StorableComponent constructor. Assigns the specified name, type,
     * location, and container, and assigns an integrally generated unique
     * id.
     * @param string $name The name to assign.
     * @param string $type The type to assign.
     * @param string $location The location to assign.
     * @param string $container The container to assign.
     * @param StorableComponent $storableComponent The StorableComponent
     *                                             instance this
     *                                             this StorableComponentConfiguration
     *                                             represents.
     */
    public function __construct(string $name, string $type, string $location, string $container, StorableComponent $storableComponent)
    {
        parent::__construct($name, $type, $location, $container);
        // 1. Determine StorableComponent instances property names
        //    and assign them to the $expectedConfigurationKeys
        //    property's array. Remember, "primary" properties
        //    of a StorableComponent MUST be reflected.
        //    i.e., ['name', 'uniqueId', 'type', 'location', 'container']
        //
        // ^ (Hint: use get_object_vars() method provided by php)
        //
        // 2. Populate the configuration array using the
        // setConfigurationValue() method to insure values
        // are only set for expected keys.
    }

    public function getExpectedConfigurationKeys(): array
    {
        return $this->expectedConfigurationKeys;
    }

    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function setConfigurationValue(string $key, $value): bool
    {
        // @todo: Implement this method.
        return false;
    }

}
