<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\Component as ComponentInterface;
use \ReflectionMethod;
/**
 * Class Component. Defines an abstract implementation of the
 * Component interface that can be implemented to define
 * niche components.
 * @package DarlingCms\abstractions\aggregate
 * @see Component
 * @see Component::getType()
 * @see Component::getName()
 * @see Component::getUniqueId()
 * @see Component::getExpectedConstructorArgumentNames()
 * @see Component::getExpectedConstructorArgumentTypes()
 * @see Component::getExpectedConstructorArgumentDefaults()
 */
abstract class Component implements ComponentInterface
{
    /**
     * @var string The assigned name.
     */
    protected $name;

    /**
     * @var string The assigned unique id.
     */
    protected $uniqueId;

    /**
     * @var string The assigned type.
     */
    protected $type;

    /**
     * Component constructor. Assigns the specified name,
     * assigns the implementation's fully qualified namespace
     * and class name as the type, and assigns an internally
     * generated unique id.
     * @param string $name The name to assign.
     */
    public function __construct(string $name)
    {
        $this->name = trim($name);
        $this->uniqueId = $this->generateUniqueId();
        $this->type = get_class($this);
    }

    /**
     * Returns the assigned name.
     * @return string The assigned name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the assigned unique id.
     * @return string The assigned unique id.
     */
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * Returns the assigned type.
     * Specifically, this implementation of the Component interface
     * returns this implementation's fully qualified namespace and
     * class name as the type.
     * @return string The assigned type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Generates a unique id.
     * @return string A unique id.
     */
    private function generateUniqueId(): string
    {
        return random_bytes(64);
    }

    /*
     * Returns a numercially indexed array of the names
     * of the arguments expected by this implementation's
     * __construct() method.
     * @return array  A numercially indexed array of the names
     *                of the arguments expected by this
     *                implementation' __construct() method.
     */
    public function getExpectedConstructorArgumentNames() : array {
        return $this->getComponentConstructorParamerterInfo('n');
    }

    /**
     * Returns an associative array of the types of the arguments
     * expected by this implementation's __construct() method,
     * indexed by argument name.
     * @return  An associative array of the types of the arguments
     *          expected by this implementation's __construct() method,
     *          indexed by argument name.
     */
    public function getExpectedConstructorArgumentTypes(): array {
        return array_combine($this->getComponentConstructorParamerterInfo('n'), $this->getComponentConstructorParamerterInfo('t'));
    }

    /**
     * Returns an associatvie array of values that can be passed
     * to the implementation's __construct() method as default values,
     * indexed by argument name.
     * @return  An associatvie array of values that can be passed
     *          to the implementation's __construct() method as
     *          default values, indexed by argument name.
     */
    public function getExpectedConstructorArgumentDefaults(): array {
        // If there are no constructor agruments, return an empty array
        if(empty($this->getComponentConstructorParamerterInfo('n'))) {
            return array();
        }
        return array_combine($this->getComponentConstructorParamerterInfo('n') , (empty($this->getExpectedConstructorArgumentDefaultValues()) === true ? $this->generateAppropriateConstructorArgumentDefaultValues() : $this->getExpectedConstructorArgumentDefaultValues()));
    }

    /**
     * Returns a numerically indexed array of internally generated default
     * values that can be assigned as the expected constructor argument
     * defaults. This method is able to generate values for arguments that
     * expect the following types of values: boolean, integer, double,
     * string, and array.
     *
     * WARNING: Arguments that expect an object instance will be assigned
     *          an instance of stdClass() since there is no way to
     *          know ahead of time what types of objects will be expected
     *          or how they should be constructed.
     */
    final private function generateAppropriateConstructorArgumentDefaultValues() : array {
        $defaults = array();
        foreach($this->getComponentConstructorParamerterInfo('t') as $type) {
            switch($type) {
                case 'boolean':
                    array_push($defaults, false);
                    break;
                case 'integer':
                    array_push($defaults, 1);
                    break;
               /**
                * Double is same as float.
                * @see https://www.php.net/manual/en/function.gettype.php for more information.
                */
                case 'double':
                    array_push($defaults, 1.2345);
                    break;
                case 'string':
                    array_push($defaults, 'Default_') . random_bytes(12);
                    break;
               case 'array':
                   array_push($defaults, array());
                   break;
               case 'object':
                   error_log('Darling Cms | Component Implementation Error: Generation of default argument for object types is not supported by the Component::generateAppropriateConstructorArgumentDefaultValues() method. Implementations of the Component abstract aggregate class that inject objects via their __construct() method MUST implement the Component::getExpectedConstructorArgumentDefaultValues() abstract method and explicitly define appropriate default values for the implementation. An instance of StdClass was used in place of the expected object. This will most likely cause bugs!!!');
                    array_push($defaults, new stdClass());
                    break;
                case 'NULL':
                    array_push($defaults, null);
                    break;
                default:
                    error_log('Darling Cms | Component Implementation Error: Generation of default argument failed, encountered unknown type. If this error continues, try implementing the Component::getExpectedConstructorArgumentDefaultValues() method and explicitly define the appropriate default values. NULL was used as default value, this will most likely cause bugs!');
                    array_push($defaults, null);
            }
        }
        return $defaults;
    }

    /**
     * Returns a numerically indexed array of values that can be passed
     *  to the implementation's __construct() method as default values.
     * Note: It is recomended that each implmentation explicitly define
     *       appropriate default constructor argument values in the
     *       array returned by this method. However, it is possible
     *       to have the base Component abstract aggregate class
     *       generate default arguments internally by returning
     *       an empty array from the implementation of this method.
     * WARNING: If the implementation of this method returns an empty
     *          array to indicate that default values should be generated
     *          internally, but the implementation's __construct() method
     *          expects arguments that are object instances, then the
     *          default values generated internally may not reflect
     *          the expected argument types since instances of stdClass()
     *          will be assigned as default values for those arguments that
     *          expect an object instance.
     *
     *          In general, it is best only to return an empty array from
     *          this method while developing a Component implementation,
     *          and to explictly define appropriate default values in the
     *          array returned by this method once development of the
     *          Component implementation is finished.
     *
     * @return A numerically indexed array of values that can be passed to the
     *         implementation's __construct() method as default values.
     */
    abstract protected function getExpectedConstructorArgumentDefaultValues() : array;

    /**
     * Request information about the Component's constructor parameters.
     * @var string $request A single character that determines what info
     *                      is returned:
     *                      n = Return array of the names of the constructor
     *                          paramters.
     *                      t = Return array of strings indicating the
     *                          constructor's parameter types.
     */
    protected function getComponentConstructorParamerterInfo(string $request): array {
        $reflection = new ReflectionMethod(get_class($this), '__construct');
        $parameterInfo = array();
        foreach($reflection->getParameters() as $reflectionParameter) {
            if($request[0] === 't') {
                /**
                 * @devNote: PHP's ReflectionNamedType()::getName() returns "bool" for boolean
                 * types, whereas PHP's getType() function returns "boolean" for boolean
                 * types, to insure consistincy enforce "boolean" is used to indicate
                 * boolean types.
                 * @see https://www.php.net/manual/en/reflectionnamedtype.getname.php
                 * @see https://www.php.net/manual/en/function.gettype.php
                 */
                 array_push($parameterInfo, str_replace('bool', 'boolean', $reflectionParameter->getType()->getName()));
                continue;
            }
            array_push($parameterInfo, $reflectionParameter->name);
        }
        return $parameterInfo;
    }
}
