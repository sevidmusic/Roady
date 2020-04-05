<?php

namespace DarlingCms\interfaces\component\UserInterface;

use DarlingCms\interfaces\component\OutputComponent as CoreOutputComponent;

interface StandardUI extends CoreOutputComponent
{

    public function getTemplatesAssignedToResponses(string $location, string $container): array;
    /**
     * @todo
     * getOutputComponentsAssignedToResponses()
     * getOutput()
     */
}
