<?php

namespace roady\classes\component\Driver\Storage;

use roady\abstractions\component\Driver\Storage\StorageDriver as StandardStorageDriverBase;
use roady\interfaces\component\Driver\Storage\StorageDriver as StandardStorageDriverInterface;

/**
 * WARNING: This implementation of the StorageDriver interface is intended to be used
 *          internally by the roady, and SHOULD NOT be used directly!
 *
 * @devNote: In my attempt to deprecate this class, and it's parent abstraction, I was
 *           reminded by failing tests that I defined this class and it's parent
 *           abstraction so a "generic" implementation of a StorageDriver would
 *           be available in the following contexts:
 *
 *           1. Reflection
 *           2. Testing
 *
 *           So, this class and it's abstract parent are REQUIRED by core, however,
 *           I do not recommend you use or extend this class or it's abstract parent
 *           directly.
 *              DONT DO THIS:
 *                  $storageDriver = new StorageDriver()
 *              INSTEAD DO SOMETHING LIKE:
 *                  $storageDriver = new JsonStorageDriver()
 *              DONT DO THIS:
 *                  class Foo extends StorageDriver {...}
 *              INSTEAD DO SOMETHING LIKE:
 *                  class Foo extends JsonStorageDriver() {}
 *
 *           If you do decide to use this class or it's parent abstraction directly,
 *           keep in mind that it is utilizing the JsonStorageDriver implementation
 *           of the StorageDriver interface to actually perform it's operations.
 *           This is another reason NOT to use this class or it's parent abstraction
 *           directly, as it is tightly coupled to the JsonStorageDriver. Basically,
 *           if you find yourself tempted to use this class, just use the JsonStorageDriver.
 *
 *           To summarize, this class and it's parent are intended for internal use by core.
 *           If you need to implement a new implementation of the StorageDriver interface,
 *           do so without including this class or it's parent abstraction in the lineage.
 *           If you want a StorageDriver interface implementation that works like this class,
 *           use the JsonStorageDriver.
 */
class StorageDriver extends StandardStorageDriverBase implements StandardStorageDriverInterface
{
    /**
     * This is a generic implementation, it does not require
     * any additional logic, the StandardBase class
     * fulfills the requirements of the StandardInterface.
     */
}
