<?php

namespace roady\interfaces\component\Registry\Storage;

use roady\interfaces\component\Component; 
use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\primary\Storable; 

/**
 * A StoredComponentRegistry is a Component that represents a 
 * collection of stored Components of the same type.
 *
 * Methods:
 *
 * public function getType(): string;
 * public function export(): array<string, mixed>;
 * public function import(array<string, mixed> $export): bool;
 * public function getName(): string;
 * public function getUniqueId(): string;
 * public function getLocation(): string;
 * public function getContainer(): string;
 * public function getAcceptedImplementation(): string;
 * public function getComponentCrud(): ComponentCrud;
 * public function registerComponent(Component $component): bool;
 * public function unRegisterComponent(Storable $storable): bool;
 * public function getRegisteredComponents(): array;
 * public function getRegistry(): array;
 * public function emptyRegistry(): void;
 * public function purgeRegistry(): void;
 *
 */
interface StoredComponentRegistry extends Component
{

    /**
     * Return the type of Component implementation that can be 
     * registered by this StoredComponentRegistry.
     *
     * @return string The type of Component implementation that can 
     *                be registered by this StoredComponentRegistry.
     */
    public function getAcceptedImplementation(): string;

    /**
     * Return the ComponentCrud used by this StoredComponentRegistry 
     * to read registered Components from storage.
     *
     * @return ComponentCrud The ComponentCrud used by this 
     *                       StoredComponentRegistry to read 
     *                       registered Components from storage.
     */
    public function getComponentCrud(): ComponentCrud;

    /**
     * Register a Component. 
     *
     * Note: The Component's type must match the accepted 
     * implementation or it will not be registered.
     *
     * Note: The Component must exist in storage or it will not
     * be registered.
     *
     * @param Component $component The Component to register.
     *
     * @return bool True if the Component was registered, 
     *             false otherwise.
     *
     */
    public function registerComponent(Component $component): bool;

    /**
     * Unregister the Component whose Storable matches the 
     * specified Storable.
     * 
     * @param Storable $storable The Storable to use to identify 
     *                           which Component is to be 
     *                           unregistered.
     *
     * @return bool True if the Component was unregistered,
     *              false otherwise.
     */
    public function unRegisterComponent(Storable $storable): bool;

    /**
     * Return a numerically indexed array of the registered 
     * Components. 
     *
     * Note: These Components will be read from storage via the 
     * ComponentCrud returned by this StoredComponentRegistry's 
     * getComponentCrud() method.
     *
     * @return array <int, Component> A numerically indexed array of 
     *                                the registered Components. 
     */
    public function getRegisteredComponents(): array;

    /**
     * Return a numerically indexed array of Storables for each of
     * the registered Components. 
     *
     * @return array<int, Storable> A numerically indexed array 
     *                              of Storables for each of the 
     *                              registered Components. 
     */
    public function getRegistry(): array;

    /**
     * Empty the registry. This will unregister all the of registered
     * Components.
     */
    public function emptyRegistry(): void;

    /**
     * Unregister any registered Components that no longer exist
     * in storage.
     */
    public function purgeRegistry(): void;

}
