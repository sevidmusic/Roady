<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as Template;
use DarlingDataManagementSystem\interfaces\primary\Positionable;

interface Response extends SwitchableComponent, Positionable
{
    public const RESPONSE_CONTAINER = "RESPONSES";

    public function respondsToRequest(Request $request, ComponentCrud $crud): bool;

    public function addRequestStorageInfo(Request $request): bool;

    public function getRequestStorageInfo(): array;

    public function removeRequestStorageInfo(string $nameOrId): bool;

    public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;

    public function removeOutputComponentStorageInfo(string $nameOrId): bool;

    public function getOutputComponentStorageInfo(): array;

    public function addTemplateStorageInfo(Template $template): bool;

    public function removeTemplateStorageInfo(string $nameOrId): bool;

    public function getTemplateStorageInfo(): array;
}
