<?php

namespace roady\interfaces\component\Driver\Storage;

use roady\interfaces\component\Component; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 

/**
 * A StorageDriver is a SwitchableComponent that can read, write, 
 * and delete Component's from some type of storage, for example: 
 * a file system, or a database.
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
 * public function read(Storable $storable): Component;
 * public function readAll(string $location, string $container): array;
 * public function write(Component $component): bool;
 * public function delete(Storable $storable): bool;
 *
 */
interface StorageDriver extends SwitchableComponent
{

    /**
     * Read a Component from storage using the specified Storable
     * to determine where the Component is expected to exist in 
     * storage.
     *
     * If the Component does not exist in storage, or if this 
     * StorageDriver's state is set to false, then a new instance
     * of a roady\classes\component\Component will be returned 
     * whose name, container, and location are all assigned the 
     * value MOCKCOMPONENT.
     *
     * @param Storable $storable The Storable to use to determine
     *                           where the Component is expected 
     *                           to exist in storage.
     *                           
     * @return Component The stored Component, or, a new instance
     *                   of a roady\classes\component\Component 
     *                   whose name, container, and location are 
     *                   all assigned the value MOCKCOMPONENT.
     */
    public function read(Storable $storable): Component;

    /**
     * Return a numerically indexed array of all the Components that 
     * are stored in a specified container at a specified location.
     *
     * Note: If this StorageDriver's state is set to false, or if 
     * there aren't any Components in the specified container at 
     * the specified location, then the returned array will be 
     * empty.
     *
     * @param string $location The name of the location to read 
     *                         the Components from.
     *
     * @param string $container The name of the container to read 
     *                          the Components from.
     *
     * @return array<int, Component> A numerically indexed array 
     *                               of all the Components that 
     *                               are stored in the specified 
     *                               container at the specified 
     *                               location. This array will
     *                               be empty if this StorageDriver's
     *                               state is set to false, or if
     *                               there aren't any Components
     *                               stored in the specified 
     *                               container at the specified 
     *                               location.
     */
    public function readAll(string $location, string $container): array;

    /**
     * Write a Component to storage. 
     *
     * Returns true if the specified Component was written 
     * to storage, false otherwise.
     *
     * Note: If this StorageDriver's state is set to false, then
     * the Component will not be written.
     *
     * @param Component $component The Component to write 
     *                             to storage.
     *
     * @return bool True if the specified Component was written to 
     *              storage, false otherwise.
     */
    public function write(Component $component): bool;

    /**
     * Delete a Component from storage using the specified Storable 
     * to determine where the Component to be deleted is expected to 
     * exist in storage.
     *
     * Note: If this StorageDriver's state is set to false, then
     * the Component will not be deleted.
     *
     * @param Storable $storable The Storable to use to determine
     *                           where the Component is expected to 
     *                           exist in storage.
     *
     * @return bool True if the Component was deleted, false 
     *              otherwise.
     *
     */
    public function delete(Storable $storable): bool;

}
