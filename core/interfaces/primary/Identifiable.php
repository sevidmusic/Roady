<?php

namespace DarlingDataManagementSystem\interfaces\primary;

interface Identifiable
{

    public function getName(): string;

    public function getUniqueId(): string;
}
