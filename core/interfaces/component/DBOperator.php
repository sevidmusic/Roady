<?php

namespace DarlingCms\interfaces\component;

use DarlingCms\interfaces\aggregate\Component;
use DateTime;
use PDO;

/**
 * Interface DBOperator. Defines the basic contract
 * of a component that can operate on a database
 * via a PDO instance.
 * @package DarlingCms\interfaces\component
 * @see DBOperator::getName()
 * @see DBOperator::getUniqueId()
 * @see DBOperator::getType()
 * @see DBOperator::getDBDriver()
 * @see DBOperator::getLastOperation()
 * @see DBOperator::getLastOperationTime()
 * @see DBOperator::getLastOperationState()
 */
interface DBOperator extends Component
{

    /**
     * Returns the PDO instance used by this instance
     * to perform operations on a database.
     * @return PDO The PDO instance used by this instance
     *              to perform operations on a database.
     */
    public function getDBDriver(): PDO;

    /**
     * Returns the last operation performed.
     * @return string The last operation performed.
     */
    public function getLastOperation():string ;

    /**
     * Returns a DateTime instance that reflects the date
     * and time of the last operation performed.
     * @return DateTime A DateTime instance that reflects
     *                   the date and time of the last
     *                   operation performed.
     */
    public function getLastOperationTime(): DateTime;

    /**
     * Returns a boolean value that reflects the state
     * of the last operation, true if operation was
     * successful, false otherwise.
     * @return bool A boolean value that reflects the state
     *              of the last operation, true if operation
     *              was successful, false otherwise.
     */
    public function getLastOperationState():bool;

}
