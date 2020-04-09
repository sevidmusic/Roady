<?php

namespace Extensions\WorkingDemoComponents\core\abstractions\component\Actions\Generate;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\abstractions\component\Action as CoreAction;
use Extensions\WorkingDemoComponents\core\interfaces\component\Actions\Generate\generateNewOutputComponent as generateNewOutputComponentInterface;

abstract class generateNewOutputComponent extends CoreAction implements generateNewOutputComponentInterface
{

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

}
