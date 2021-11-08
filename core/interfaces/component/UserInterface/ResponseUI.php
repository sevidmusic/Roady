<?php

namespace roady\interfaces\component\UserInterface;

use roady\interfaces\component\OutputComponent; 
use roady\interfaces\component\Web\Routing\Router; 

/**
 * A ResponseUI is an OutputComponent whose output is generated
 * from the collective output of all of the OutputComponents that
 * are assigned to each of the Responses returned by a Router
 * in response to a specific Request.
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
 * public function getOutput(): string;
 * public function increasePosition(): bool;
 * public function decreasePosition(): bool;
 * public function getPosition(): float;
 * public function getRouter(): Router;
 *
 */
interface ResponseUI extends OutputComponent
{

    /**
     * Return the collective output of all of the OutputComponents 
     * that are assigned to each of the Responses returned by the
     * Router used by this ResponseUI in response to a Request.
     *
     * Note: The collective output of the OutputComponents 
     * assigned to each Response will be sorted relative to
     * the collective output of the OutputComponents assigned
     * to the other Responses based on each Response's assigned 
     * numeric position.
     *
     * Note: The output of each OutputComponent assigned to a 
     * Response will be sorted relative to the output of the 
     * other OutputComponents that are assigned to the same 
     * Response based on each OutputComponent's assigned numeric
     * position.
     *
     * @return string The collective output of all of the 
     *                OutputComponents that are assigned to 
     *                each of the Responses returned by the
     *                Router used by this ResponseUI.
     *
     * @throws \RuntimeException Throws a RuntimeException if the 
     *                           collective output is empty.
     */
    public function getOutput(): string;

    /**
     * Return the Router used by this ResponseUI. 
     *
     * @return Router The Router used by this ResponseUI.
     *
     */
    public function getRouter(): Router;
}
