<?php

namespace DarlingDataManagementSystem\interfaces\primary;

interface Exportable extends Classifiable
{

    /**
     * @return array<mixed>
     */
    public function export(): array;

    /**
     * @param array<mixed> $export
     */
    public function import(array $export): bool;

}
