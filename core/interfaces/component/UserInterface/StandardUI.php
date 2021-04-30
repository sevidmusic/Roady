<?php

namespace DarlingDataManagementSystem\interfaces\component\UserInterface;

use DarlingDataManagementSystem\interfaces\component\OutputComponent as CoreOutputComponent;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;

interface StandardUI extends CoreOutputComponent
{

    /**
     * @return array<string, array<string, StandardUITemplateInterface>>
     */
    public function getTemplatesAssignedToResponses(): array;

    /**
     * @return array<string, array<string, array<string, OutputComponentInterface>>>
     */
    public function getOutputComponentsAssignedToResponses(): array;

}
