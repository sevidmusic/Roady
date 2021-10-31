<?php

namespace roady\interfaces\component;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

/**
 * A SwitchableComponent is a Component that has a switchable boolean state.
 *
 *  Methods:
 *
 *  public function getName(): string;
 *  public function getUniqueId(): string;
 *  public function getType(): string;
 *  public function getLocation(): string;
 *  public function getContainer(): string;
 *  public function export(): array;
 *  public function import(array $export): bool;
 *  public function getState(): bool;
 *  public function switchState(): bool;
 *
 */
interface SwitchableComponent extends SwitchableInterface, ComponentInterface
{

}
