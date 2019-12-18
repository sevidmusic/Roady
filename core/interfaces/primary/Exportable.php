<?php

namespace DarlingCms\interfaces\primary;

interface Exportable {

    public function export():array;

    public function import(array $export):bool;

}
