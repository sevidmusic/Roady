<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\StorableComponentConfiguration as StorableComponentConfigurationInterface;

/**
 * Class StorableComponentConfiguration. Defines an abstract implementation
 * of the StorableComponentConfiguration interface that extends the
 * StorableComponent abstract class that can be used to define a storable
 * representation of another StorableComponent's defined properties as a
 * collection of configuration key value pairs that correspond to the
 * represented StorableComponent's property names and property values,
 * respectively.
 * @package DarlingCms\abstractions\aggregate
 * @see StorableComponentConfiguration::getName()
 * @see StorableComponentConfiguration::getUniqueId()
 * @see StorableComponentConfiguration::getType()
 * @see StorableComponentConfiguration::getLocation()
 * @see StorableComponentConfiguration::getContainer()
 * @see StorableComponentConfiguration::getExpectedConfigurationKeys()
 * @see StorableComponentConfiguration::getConfiguration()
 * @see StorableComponentConfiguration::setConfigurationValue()
 */
abstract class StorableComponentConfiguration extends StorableComponent implements StorableComponentConfigurationInterface
{

    /**
     * @var array Array of the names of the expected configuration keys,
     *            these names correspond to the expected property names
     *            of the StorableComponent implementation instance
     *            represented by this StorableComponentConfiguration
     *            implementation instance.
     */
    protected $expectedConfigurationKeys = array();

    /**
     * @var array Array of key value pairs that represent the
     *            properties of the StorableComponent implementation
     *            instance represented by this StorableComponentConfiguration
     *            implementation instance.
     *
     */
    protected $configuration = array();


    /**
     * StorableComponent constructor. Assigns the specified name, type,
     * location, and container, assigns an internally generated unique
     * id, and generates a configuration based on the supplied
     * StorableComponent implementation instance.
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
        $this->expectedConfigurationKeys = array_keys(get_object_vars($storableComponent));
        // @todo: Populate the configuration array using the
        // setConfigurationValue() method to insure values
        // are only set for expected keys.
    }

    /**
     * Returns a single dimensional numerically indexed array
     * of the names of the expected configuration keys.
     * These names correspond to the expected properties
     * of the StorableComponent implementation instance
     * this StorableComponentConfiguration implementation
     * instance represents.
     * @return array A single dimensional numerically indexed array
     *               of the names of the expected configuration keys.
     */
    public function getExpectedConfigurationKeys(): array
    {
        return $this->expectedConfigurationKeys;
    }

    /**
     * Returns an array of key value pairs that represent the property
     * names and property values of the StorableComponent implementation
     * instance represented by this StorableComponentConfiguration
     * implementation instance, respectively.
     * @return array An array of key value pairs that represent the
     *               property names and property values of the
     *               StorableComponent implementation instance
     *               represented by this StorableComponentConfiguration
     *               implementation instance, respectively.
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * Set a configuration key value pair.
     * @param string $key The name of the key, this name should
     *                    correspond to the name of the property
     *                    this configuration setting represents.
     * @param mixed $value The value to assign to the key.
     * @return bool True if value was assigned to the key, false
     *              otherwise.
     */
    public function setConfigurationValue(string $key, $value): bool
    {
        // @todo: Implement this method.
        return false;
    }

}
