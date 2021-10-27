<?php

namespace roady\interfaces\component;

use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Storable as StorableInterface;

/**
 * A Component has an alpha-numeric name, a unique alpha-numeric id,
 * can articulate its own type, can be stored in a specific container
 * at a specific location, can export its properties as an array of
 * values that are indexed by property name, and can have its
 * properties set by importing an array of values that are indexed
 * by property name.
 */
interface Component extends IdentifiableInterface, ClassifiableInterface, StorableInterface, ExportableInterface
{

}
