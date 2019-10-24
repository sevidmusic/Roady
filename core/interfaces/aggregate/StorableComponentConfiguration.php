<?php

namespace DarlingCms\interfaces\aggregate;

/**
 * Interface StorableComponentConfiguration. Defines an implementation
 * of the StorableComponent aggregate interface that defines the
 * basic contract of a StorableComponent that can be used to
 * define a storable representation of another StorableComponent's
 * defined properties as a collection of configuration key value
 * pairs that correspond to the represented StorableComponent's
 * property names and property values, respectively.
 *
 * Note: Important Distinction:
 *       The methods inherited from the primary interfaces,
 *       i.e., getName(), getUniqueId(), etc, should reflect
 *       the StorableComponentConfiguration instance, NOT the
 *       StorableComponent the StorableComponentConfiguration
 *       represents.
 *       For example:
 *
 * // returns the name of this StorableComponentConfiguration instance.
 *
 *           self::getName()
 *
 * // returns the name of the StorableComponent this
 *    StorableComponentConfiguration instance represents.
 *
 *           self::getConfiguration()['name']
 *
 * @package DarlingCms\interfaces\aggregate
 * @see StorableComponentConfiguration::getName()
 * @see StorableComponentConfiguration::getUniqueId()
 * @see StorableComponentConfiguration::getType()
 * @see StorableComponentConfiguration::getLocation()
 * @see StorableComponentConfiguration::getContainer()
 * @see StorableComponentConfiguration::getExpectedConfigurationKeys()
 * @see StorableComponentConfiguration::getConfiguration()
 * @see StorableComponentConfiguration::setConfigurationValue()
 *
 */
interface StorableComponentConfiguration extends StorableComponent
{

    /**
     * Returns a single dimensional numerically indexed array
     * of the names of the keys that correspond to the names
     * of the properties of the StorableComponent this
     * StorableComponentConfiguration represents.
     *
     * Note: This array MUST have at least the following definition:
     *
     *       array("name", "uniqueId", "type", "location", "container")
     *
     * This is required because all implementations of this interface
     * MUST at least represent the properties of a StorableComponent
     * in their configuration, therefore, the expected configuration
     * keys defined MUST at least reflect the primary property names
     * of a StorableComponent.
     *
     * @return array A single dimensional numerically indexed array
     *               of the names of the keys that correspond to the
     *               names of the properties of the StorableComponent
     *               this StorableComponentConfiguration represents.
     *               This array MUST have at least the following
     *               definition:
     *
     *              array("name", "uniqueId", "type", "location",
     *                   "container")
     *
     */
    public function getExpectedConfigurationKeys():array;

    /**
     * Returns an array of key value pairs that represent the
     * property names and property values of the StorableComponent
     * this StorableComponentConfiguration represents.
     *
     * Note:
     *       This array MUST at least define values for the
     *       expected keys defined in the array returned
     *       by the getExpectedConfigurationKeys() method.
     *
     *       For Example:
     *
     *       If getExpectedConfigurationKeys() returns the following
     *       array:
     *
     *           array('foo')
     *
     *       Then getConfiguration() must return an array with a value
     *       assigned to a key named "foo", i.e.,
     *
     *           array("foo" => "fooValue")
     *
     * @return array An array of key value pairs that represent the
     *               property names and property values of the
     *               StorableComponent this StorableComponentConfiguration
     *               represents.
     *
     */
    public function getConfiguration():array;

    /**
     * Set a configuration value.
     *
     * Note: Implementations SHOULD only allow values to be set
     *       for keys that are defined in the array returned by
     *       the getExpectedConfigurationKeys() method.
     *
     * @param string $key The configuration key the value will be
     *                    assigned to. (Hint: The key corresponds
     *                    to the name of the property being
     *                    represented)
     * @param $value mixed The value to assign. (Hint: The value
     *                     corresponds to the value of the property
     *                     being represented)
     * @return bool True if configuration value was assigned to the
     *              specified configuration key, false otherwise.
     */
    public function setConfigurationValue(string $key, $value):bool;

}
