<?php

namespace DarlingCms\interfaces\primary;

use DarlingCms\interfaces\primary\Identifiable;

interface Storable extends Identifiable {
    public function getLocation():string;
    public function getContainer():string;
}
