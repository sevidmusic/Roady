<?php

namespace UnitTests\abstractions\database;

use DarlingCms\abstractions\database\DatabaseTableField;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use ReflectionMethod;
use UnitTests\abstractions\aggregate\StorableComponentTest;
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

    /**
     * Assert that the getFieldDataType() method returns
     * a boolean.
     */
    public function testGetFieldDataTypeReturnsBoolean() {
        $this->assertIsBool($this->component->getFieldDataType());
    }

    /**
     * Assert that the fieldCanBeNull() method returns
     * a boolean.
     */
    public function testFieldCanBeNullReturnsBoolean() {
        $this->assertIsBool($this->component->fieldCanBeNull());
    }

    /**
     * Assert that the fieldIsUnsigned() method returns
     * a boolean.
     */
    public function testFieldIsUnsignedReturnsBoolean() {
        $this->assertIsBool($this->component->fieldIsUnsigned());
    }

    /**
     * Assert that the fieldAutoIncrements() method returns
     * a boolean.
     */
    public function testFieldAutoIncrementsReturnsBoolean() {
        $this->assertIsBool($this->component->fieldAutoIncrements());
    }

    /**
     * Assert that the fieldIsPrimaryKey() method returns
     * a boolean.
     */
    public function testFieldIsPrimaryKeyReturnsBoolean() {
        $this->assertIsBool($this->component->fieldIsPrimaryKey());
    }

    /**
     * Assert that the fieldIsUniqueId() method returns
     * a boolean.
     */
    public function testFieldIsUniqueReturnsBoolean() {
        $this->assertIsBool($this->component->fieldIsUnique());
    }
}
