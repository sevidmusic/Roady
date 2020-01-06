<?php

namespace DarlingCms\interfaces\primary;

interface Identifiable
{

    public function getName(): string;

    public function getUniqueId(): string;
}
