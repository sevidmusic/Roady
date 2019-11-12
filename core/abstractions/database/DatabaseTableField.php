<?php

namespace DarlingCms\abstractions\database;

use DarlingCms\abstractions\aggregate\StorableComponent;

/* @todo implement interface use DarlingCms\interfaces\database\DatabaseTableField as DatabaseTableFieldInterface */;

/**
 * Class DatabaseTableField. Defines an abstract implementation of the
 * DatabaseTableField interface that can be implemented to define
 * niche database table fields.
 * @package DarlingCms\abstractions\database
 */
abstract class DatabaseTableField extends StorableComponent /* @todo: Defineinterface: implements DatabaseTableFieldInterface */
{

    protected $fieldDataType;
    protected $fieldCanBeNull;
    protected $fieldIsUnsigned;
    protected $fieldAutoIncrements;
    protected $fieldIsPrimaryKey;
    protected $fieldIsUnique;
    /**
     * DatabaseTableField constructor. Assigns the name, location, container,
     * field data type, field can be null setting, field is unsigned setting,
     * field auto increments setting, field is primary key setting, and the
     * field is unique setting.
     * @param string $name The field's name.
     * @param string $location The name of the database this storable component is stored in.
     *                         Note; This is NOT necessarily the database the table the field
     *                         belongs to is stored in, this is specifically the name of the
     *                         database this storable component's data is stored in.
     * @param string $container The name of the table this storable component is stored in.
     *                          Note: This is NOT necessarily the table the field is stored in,
     *                          this is specifically the name of the table this stroable
     *                          component's data is stored in.
     *
     * @param string $fieldDataType The fields data type.
     * @param bool $fieldCanBeNull Set to true if field can be null, false otherwise.
     * @param bool $fieldIsUnsigned Set to true if field is unsigned, false otherwise.
     * @param bool $fieldAutoIncrements Set to true if field auto increments, false otherwise.
     * @param bool $fieldIsPrimaryKey Set to true if field is primary key, false otherwise.
     * @param bool $fieldIsUnique Set to true if field is unique, false otherwise.
     */
    public function __construct(string $name, string $location, string $container, string $fieldDataType, bool $fieldCanBeNull, bool $fieldIsUnsigned, bool $fieldAutoIncrements, bool $fieldIsPrimaryKey, bool $fieldIsUnique)
    {
        parent::__construct($name, $location, $container);
        $this->fieldDataType = $fieldDataType;
        $this->fieldCanBeNull = $fieldCanBeNull;
        $this->fieldIsUnsigned = $fieldIsUnsigned;
        $this->fieldAutoIncrements = $fieldAutoIncrements;
        $this->fieldIsPrimaryKey = $fieldIsPrimaryKey;
        $this->fieldIsUnique = $fieldIsUnique;
    }

    /**
     * @todo: Define abstract protected method, getDefaultConstructorArgumentValues(),
     *        in Component.php that is required to be defined and use that new method
     *        to get the default values, so insetad of:
     *            return array_combine($this->getComponentConstructorParamerterInfo('n'), array('DefaultName', 'DefaultLocation', 'DefaultContainer'));
     *        It would be:
     *            return array_combine($this->getComponentConstructorParamerterInfo('n'), $this->getDeaultConstructorArgumentVaules());
     *        This would allow this method to be defined once in Component.php, and all child
     *        implementations would implement protected function getDefaultConstructorArgumentValues());
     *        instead of implementing getExpectedConstructorArgumentDefaults(), this also makes
     *        definition of default values easier because child implementations do not have to
     *        worry about remebering to assgin the argument names as keys since that will always
     *        be handled by the getExpectedConstructorArgumentDefaults() method defined in
     *        Component.php.
     */
    public function getExpectedConstructorArgumentDefaults() : array {
        return array_combine($this->getComponentConstructorParamerterInfo('n'), array('TableFieldPrototype','Components','Databas','int',false,false,true,false,true));
    }

    /**
     * Returns the field's data type.
     * @return string The field's datatype.
     */
    public function getFieldDataType() : string {
        return $this->fieldDataType;
    }

    /**
     * Returns true if the field can be null, false otherwise.
     * @return bool True if field can be null, false otherwise.
     */
    public function fieldCanBeNull() : bool {
        return $this->fieldCanBeNull;
    }

    /**
     * Returns true if field is unsigned, false otherwise.
     * @return bool True if field is unsigned, false otherwise.
     */
    public function fieldIsUnsigned() : bool {
        return $this->fieldIsUnsigned;
    }

    /**
     * Returns true if field auto increments, false otherwise.
     * @return bool True if field auto increments, false otherwise.
     */
    public function fieldAutoIncrements() : bool {
        return $this->fieldAutoIncrements;
    }

    /**
     * Returns true if field is primary key.
     * @return bool True if field is primary key, false otherwise.
     */
    public function fieldIsPrimaryKey() : bool {
        return $this->fieldIsPrimaryKey;
    }

    /**
     * Returns true if field is unique, false otherwise.
     * @return bool True if field is unique, false otherwise.
     */
    public function fieldIsUnique() : bool {
        return $this->fieldIsUnique;
    }
}
