<?php

namespace roady\interfaces\component;

use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Storable as StorableInterface;

/**
 * This interface defines an object that has an alpha-numeric name,
 * a unique alpha-numeric id, can articulate its own type, can be stored
 * in a specific container at a specific location, whose property values
 * can be exported, and whose property values can be set via an import of
 * property values exported from another Exportable object of the same type.
 */
interface Component extends IdentifiableInterface, ClassifiableInterface, StorableInterface, ExportableInterface
{

}
