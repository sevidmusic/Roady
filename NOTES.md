# Development Notes

This document is for notes related to the development of roady v2.0.

# Interfaces:

### Storage Drivers

```
<?php

namespace roady\interfaces\events\storage;

interface Write
{

    public function write(Domain $domain, Component $component): void;

}

```

```
<?php

namespace roady\interfaces\events\storage;

interface Read
{

    public function domain(): Domain;

    public function readById(
        Domain $domain,
        ClassString $type,
        Id $id,
    ): Component;

    public function readByName(
        Domain $domain,
        ClassString $type,
        Name $name,
    ): array<int, Component>;

    public function readAllByType(
        Domain $domain,
        ClassString $type,
    ): array<int, Component>;

    public function readAllBySwitchable(
        Domain $domain,
        ClassString $type,
        Switchable $switchable,
    ): array<int, Component>;
}

```

