<?php

namespace UnitTests\abstractions\database;

use DarlingCms\abstractions\database\DatabaseTableField;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;

/**
 * Class DatabaseTableFieldTest. Defines tests for the
 * DarlingCms\abstractions\database\DatabaseTableField abstract class.
 */
class DatabaseTableFieldTest extends StorableComponentTest
{
    /**
     * @var DatabaseTableField|MockObject PhpUnit mock object
     *                           instance that represents
     *                           the DarlingCms\abstractions\database\DatabaseTableField
     *                           abstract class implementation that will
     *                           be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\database\DatabaseTableField
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = [
            'PrimaryKeyFieldFoo',
            'int',
            false,
            false,
            true,
            true,
            true
        ];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\database\DatabaseTableField', $constructorArgs);
    }
}
