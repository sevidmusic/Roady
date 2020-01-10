<?php


namespace DarlingCms\interfaces\component;


use DarlingCms\interfaces\primary\Classifiable;
use DarlingCms\interfaces\primary\Exportable;
use DarlingCms\interfaces\primary\Identifiable;
use DarlingCms\interfaces\primary\Storable;

interface Component extends Identifiable, Classifiable, Storable, Exportable
{

}