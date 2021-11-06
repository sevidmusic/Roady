<?php

namespace roady\interfaces\component\Crud;

use roady\interfaces\component\Component; 
use roady\interfaces\component\SwitchableComponent; 
use roady\interfaces\primary\Storable; 

/**
 * A ComponentCrud is a SwitchableComponent that can be used to
 * create, read, update, and delete stored Components.
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
 * public function create(Component $component): bool;
 * public function read(Storable $storable): Component;
 * public function update(Storable $storable, Component $component): bool;
 * public function delete(Storable $storable): bool;
 * public function readAll(string $location, string $container): array;
 * public function readByNameAndType(string $name, string $type, string $location, string $container): Component;
 *
 */
interface ComponentCrud extends SwitchableComponent
{

    /**
     * Create a Component in storage. 
     *
     * Returns true if the specified Component was created 
     * in storage, false otherwise.
     *
     * Note: If this ComponentCrud's state is set to false, then
     * the Component will not be created.
     *
     * @param Component $component The Component to create 
     *                             in storage.
     *
     * @return bool True if the specified Component was created in 
     *              storage, false otherwise.
     */
    public function create(Component $component): bool;

    /**
     * Read a Component from storage using the specified Storable
     * to determine where the Component is expected to exist in 
     * storage.
     *
     * If the Component does not exist in storage, or if this 
     * ComponentCrud's state is set to false, then a new instance
     * of a roady\classes\component\Component will be returned 
     * whose name, container, and location are all assigned the 
     * value __MOCK_COMPONENT__.
     *
     * @param Storable $storable The Storable to use to determine
     *                           where the Component is expected 
     *                           to exist in storage.
     *                           
     * @return Component The stored Component, or, a new instance
     *                   of a roady\classes\component\Component 
     *                   whose name, container, and location are 
     *                   all assigned the value __MOCK_COMPONENT__.
     */
    public function read(Storable $storable): Component;

    /**
     * Update a stored Component using the specified Storable to
     * determine where the Component to be updated is expected to 
     * exist in storage.
     *
     * Note: If this ComponentCrud's state is set to false, then
     * the Component will not be updated.
     *
     * @param Storable $storable The Storable to use to determine
     *                           where the Component is expected 
     *                           to exist in storage.
     *
     * @param Component $component The new Component that will
     *                             replace the original Component.
     *
     * @return bool True if the Component was updated, false 
     *              otherwise.
     */
    public function update(Storable $storable, Component $component): bool;

    /**
     * Delete a Component from storage using the specified Storable 
     * to determine where the Component to be deleted is expected to 
     * exist in storage.
     *
     * Note: If this ComponentCrud's state is set to false, then
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

    /**
     * Return a numerically indexed array of all the Components that 
     * are stored in a specified container at a specified location.
     *
     * Note: If this ComponentCrud's state is set to false, or if 
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
     *
     * @return array<int, Component> A numerically indexed array 
     *                               of all the Components that 
     *                               are stored in the specified 
     *                               container at the specified 
     *                               location. This array will
     *                               be empty if this ComponentCrud's
     *                               state is set to false, or if
     *                               there aren't any Components
     *                               stored in the specified 
     *                               container at the specified 
     *                               location.
     */
    public function readAll(string $location, string $container): array;

    /**
     * Read a Component from storage based on a specified name,
     * type, location, and container.
     * 
     * Note: If this ComponentCrud's state is set to false, then
     * an instance of a roady\classes\component\Component whose 
     * name, container, and location are assigned the value DEFAULT 
     * will be returned. 
     *
     * @param string $name The name of the Component to read from
     *                     storage.
     *
     * @param string $type The expected type of the Component to 
     *                     read from storage.
     *
     * @param string $location The name of the location the Component
     *                         is expected to exist at. 
     * 
     * @param string $container The name of the container the 
     *                          Component is expected to exist in. 
     *
     * @return Component A Component read from the specified 
     *                   container at the specified location
     *                   whose name matches the specified name,
     *                   and whose type matches the specified type.
     *
     *                   Or, if this ComponentCrud's state is 
     *                   set to false, an instance of a 
     *                   roady\classes\component\Component 
     *                   whose name, container, and location 
     *                   are assigned the value DEFAULT.
     *
     * @throws \RuntimeException Throws a RuntimeException if a 
     *                           match is not found.
     */
    public function readByNameAndType(string $name, string $type, string $location, string $container): Component;

}
