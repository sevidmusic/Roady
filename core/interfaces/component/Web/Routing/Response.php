<?php

namespace DarlingDataManagementSystem\interfaces\component\Web\Routing;

use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;

interface Response extends SwitchableComponentInterface, PositionableInterface
{
    public const RESPONSE_CONTAINER = "RESPONSES";

    public function respondsToRequest(Request $request, ComponentCrudInterface $crud): bool;

    public function addRequestStorageInfo(Request $request): bool;

    /**
     * @return array<int, StorableInterface>
     */
    public function getRequestStorageInfo(): array;

    public function removeRequestStorageInfo(string $nameOrId): bool;

    public function addOutputComponentStorageInfo(OutputComponentInterface $outputComponent): bool;

    public function removeOutputComponentStorageInfo(string $nameOrId): bool;

    /**
     * @return array<int, StorableInterface>
     */
    public function getOutputComponentStorageInfo(): array;

    public function addTemplateStorageInfo(StandardUITemplateInterface $template): bool;

    public function removeTemplateStorageInfo(string $nameOrId): bool;

    /**
     * @return array<int, StorableInterface>
     */
    public function getTemplateStorageInfo(): array;
}
