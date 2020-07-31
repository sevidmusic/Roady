<?php


namespace DarlingDataManagementSystem\interfaces\component;


use DarlingDataManagementSystem\interfaces\primary\Classifiable;
use DarlingDataManagementSystem\interfaces\primary\Exportable;
use DarlingDataManagementSystem\interfaces\primary\Identifiable;
use DarlingDataManagementSystem\interfaces\primary\Storable;

interface Component extends Identifiable, Classifiable, Storable, Exportable
{

}