<?php

namespace DarlingDataManagementSystem\interfaces\primary;

interface Storable extends Identifiable
{
    public function getLocation(): string;

    public function getContainer(): string;
}
