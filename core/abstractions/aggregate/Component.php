<?php

namespace DarlingCms\abstractions\aggregate;

use DarlingCms\interfaces\aggregate\Component as ComponentInterface;

/**
 * Class Component. Defines an abstract implementation of the
 * Component interface that can be implemented to define
 * niche components.
 * @package DarlingCms\abstractions\aggregate
 * @see Component
 * @see Component::getType()
 * @see Component::getName()
 * @see Component::getUid()
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
    protected $uid;

    /**
     * @var string The assigned type.
     */
    protected $type;

    /**
     * Component constructor. Assigns the specified name and
     * type, and generates a unique id.
     * @param string $name The name to assign.
     * @param string $type The type to assign.
     */
    public function __construct(string $name, string $type)
    {
        $this->name = trim($name);
        $this->uid = $this->generateUniqueId();
        $this->type = trim($type);
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
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * Returns the assigned type.
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
        /**
         * @todo Refactor to use more reliable unique id generation logic.
         */
        return str_shuffle('sdh65za4hj45h454jgf76hfdhgsea74ioased5782asdwsdfa789suois98asuliah8yh3gibjh4vbuytd87sduihgb4y3tg78gdfgs89dfg89dfg8iu3wpsdjsdfjgjfj3jf8si');
    }
}
