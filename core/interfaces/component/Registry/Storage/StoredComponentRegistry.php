<?php

namespace roady\interfaces\component\Registry\Storage;

use roady\interfaces\component\Component as ComponentInterface;
use roady\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use roady\interfaces\primary\Storable as StorableInterface;

interface StoredComponentRegistry extends ComponentInterface
{

    public function getAcceptedImplementation(): string;

    public function getComponentCrud(): ComponentCrudInterface;

    public function registerComponent(ComponentInterface $component): bool;

    public function unRegisterComponent(StorableInterface $storable): bool;

    /**
     * @return array <int, ComponentInterface>
     */
    public function getRegisteredComponents(): array;

    /**
     * @return array<int, StorableInterface>
     */
    public function getRegistry(): array;

    public function emptyRegistry(): void;

    public function purgeRegistry(): void;

}
