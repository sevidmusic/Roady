<?php

namespace roady\interfaces\component\Registry\Storage;

use roady\interfaces\component\Component; 
use roady\interfaces\component\Crud\ComponentCrud; 
use roady\interfaces\primary\Storable; 

/**
 * A StoredComponentRegistry represents a collection of stored
 * Components of the same type. 
 */
interface StoredComponentRegistry extends Component
{

    public function getAcceptedImplementation(): string;

    public function getComponentCrud(): ComponentCrud;

    public function registerComponent(Component $component): bool;

    public function unRegisterComponent(Storable $storable): bool;

    /**
     * @return array <int, Component>
     */
    public function getRegisteredComponents(): array;

    /**
     * @return array<int, Storable>
     */
    public function getRegistry(): array;

    public function emptyRegistry(): void;

    public function purgeRegistry(): void;

}
