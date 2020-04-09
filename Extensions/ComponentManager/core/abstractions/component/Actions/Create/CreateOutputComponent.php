<?php

namespace Extensions\ComponentManager\core\abstractions\component\Actions\Create;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\abstractions\component\Action as CoreAction;
use Extensions\ComponentManager\core\interfaces\component\Actions\Create\CreateOutputComponent as CreateOutputComponentInterface;

abstract class CreateOutputComponent extends CoreAction implements CreateOutputComponentInterface
{

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }

    public function do(Request $currentRequest): bool
    {
        if (isset($currentRequest->getPost()['componentName']) === false) {
            $currentRequest->import(['post' => ['componentName' => 'ERROR_COMPONENT_NAME_WAS_NOT_SPECIFIED']]);
        }
        return parent::do($currentRequest);
    }

}
