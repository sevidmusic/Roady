<?php

namespace UnitTests\abstractions\database;

use DarlingCms\abstractions\database\DatabaseTable;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;
use UnitTests\abstractions\aggregate\StorableComponentTest;
/**
 * Class DatabaseTableTest. Defines tests for the
 * DarlingCms\abstractions\database\DatabaseTable abstract class.
 */
class DatabaseTableTest extends StorableComponentTest
{
    /**
     * @var DatabaseTable|MockObject PhpUnit mock object
     *                           instance that represents
     *                           the DarlingCms\abstractions\database\DatabaseTable
     *                           abstract class implementation that will
     *                           be used for testing.
     */
    protected $component;

    /**
     * Setup the mock object instance of the
     * DarlingCms\abstractions\database\DatabaseTable
     * abstract class that will be used for testing.
     */
    public function setUp(): void
    {
        $constructorArgs = [
            'PrimaryKeyFieldFoo',
            'Components',
            'DatabaseComponents',
            'int',
            false,
            false,
            true,
            false,
            true
        ];
        $this->component = $this->getMockForAbstractClass('\DarlingCms\abstractions\database\DatabaseTable', $constructorArgs);
    }
}
