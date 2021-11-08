<?php

namespace roady\interfaces\component\Web;

use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\component\SwitchableComponent;
use roady\interfaces\component\Web\Routing\Request;

/**
 * An App is a SwitchableComponent
 * 
 * Constants:
 *
 * APP_CONTAINER: string 
 *
 * Methods:
 *
 * public function getState(): bool;
 * public function switchState(): bool;
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array<string, mixed> $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public static function deriveAppLocationFromRequest(Request $request): string;
 * public function getAppDomain(): Request;
 *
 */
interface App extends SwitchableComponent
{

    public const APP_CONTAINER = "APP";

    public static function deriveAppLocationFromRequest(Request $request): string;

    public function getAppDomain(): Request;

}
