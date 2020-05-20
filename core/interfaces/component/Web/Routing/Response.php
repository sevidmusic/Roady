<?php

namespace DarlingCms\interfaces\component\Web\Routing;

use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\SwitchableComponent;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate as Template;
use DarlingCms\interfaces\primary\Positionable;

interface Response extends SwitchableComponent, Positionable
{
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
