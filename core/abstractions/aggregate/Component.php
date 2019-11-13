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
     * expected by this implementation's __construct method, indexed
     * by argument name.
     * @return  An associative array of the types of the arguments
     *          expected by this implementation's __construct method,
     *          indexed by argument name.
     */
    public function getExpectedConstructorArgumentTypes(): array {
        return array_combine($this->getComponentConstructorParamerterInfo('n'), $this->getComponentConstructorParamerterInfo('t'));
    }

    /**
     * Returns an associatvie array of values that can be passed
     * to the implementation's __construct method as default values,
     * indexed by argument name.
     * @return  An associatvie array of values that can be passed
     *          to the implementation's __construct method as
     *          default values, indexed by argument name.
     */
    public function getExpectedConstructorArgumentDefaults(): array {
        return array_combine($this->getComponentConstructorParamerterInfo('n'), array('DefaultName'));
    }

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
