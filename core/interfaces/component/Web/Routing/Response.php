<?php

namespace DarlingCms\interfaces\component\Web\Routing;

use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\SwitchableComponent;

interface Response extends SwitchableComponent
{

    public function addRequest(Request $request): bool;

    public function removeRequest(string $nameOrId): bool;

    public function respondsToRequest(Request $request): bool;

    public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool;

    public function removeOutputComponentStorageInfo(string $nameOrId): bool;

    public function getOutputComponentStorageInfo(): array;

}
