<?php

namespace DarlingCms\interfaces\component\UserInterface;

use DarlingCms\interfaces\component\OutputComponent as CoreOutputComponent;

interface StandardUI extends CoreOutputComponent
{

    // getTemplatesForCurrentRequest(): array | index by position
    public function getTemplatesForCurrentRequest(string $location, string $container): array;
    //
    // getOutputComponentsForCurrentRequest():array | index by type, then position
    //
    // getOutput() : | string constrcuted from aggregate of OCs organized by Templates
    // getActionsForCurrentRequest() | index by position
}
