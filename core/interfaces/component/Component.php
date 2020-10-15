<?php

namespace DarlingDataManagementSystem\interfaces\component;

use DarlingDataManagementSystem\interfaces\primary\Classifiable as ClassifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Exportable as ExportableInterface;
use DarlingDataManagementSystem\interfaces\primary\Identifiable as IdentifiableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;

interface Component extends IdentifiableInterface, ClassifiableInterface, StorableInterface, ExportableInterface
{

}
