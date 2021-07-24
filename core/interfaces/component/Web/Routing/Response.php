<?php

namespace roady\interfaces\component\Web\Routing;

use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\component\OutputComponent as OutputComponentInterface;
use roady\interfaces\component\SwitchableComponent as SwitchableComponentInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Positionable as PositionableInterface;

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

}
