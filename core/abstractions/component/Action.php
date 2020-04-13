<?php

namespace DarlingCms\abstractions\component;

use DarlingCms\interfaces\primary\Storable as CoreStorableInterface;
use DarlingCms\classes\primary\Storable;
use DarlingCms\interfaces\primary\Switchable as CoreSwitchableInterface;;
use DarlingCms\classes\primary\Switchable;
use DarlingCms\interfaces\primary\Positionable;
use DarlingCms\interfaces\component\Web\Routing\Request as CoreRequestInterface;
use DarlingCms\classes\component\Web\Routing\Request;
use DarlingCms\abstractions\component\OutputComponent as CoreOutputComponent;
use DarlingCms\interfaces\component\Action as ActionInterface;

abstract class Action extends CoreOutputComponent implements ActionInterface
{
    private $currentRequest;

    public function __construct(CoreStorableInterface $storable, Switchable $switchable, Positionable $positionable)
    {
        parent::__construct($storable, $switchable, $positionable);
    }


    public function getCurrentRequest(): CoreRequestInterface
    {
        if(isset($this->currentRequest) === false)
        {
            $this->currentRequest = new Request(
                new Storable('ActionTest_CurrentRequest','ActionTest','ActionTestRequests'),
                new Switchable()
            );
        }
        return $this->currentRequest;
    }

}
