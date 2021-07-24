<?php

namespace roady\interfaces\component;

use roady\interfaces\primary\Classifiable as ClassifiableInterface;
use roady\interfaces\primary\Exportable as ExportableInterface;
use roady\interfaces\primary\Identifiable as IdentifiableInterface;
use roady\interfaces\primary\Storable as StorableInterface;

interface Component extends IdentifiableInterface, ClassifiableInterface, StorableInterface, ExportableInterface
{

}
