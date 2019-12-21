<?php

namespace DarlingCms\interfaces\primary;

interface Exportable extends Classifiable
{

    public function export(): array;

    public function import(array $export): bool;

}
