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

    private function setInPost(Request $request, string $name, $value): array
    {
        $post = $request->getPost();
        $post[strval($name)] = $value;
        return $post;
    }

    public function do(Request $currentRequest): bool
    {
        if (isset($currentRequest->getPost()['componentName']) === false) {
            $currentRequest->import(['post' => $this->setInPost($currentRequest, 'componentName', 'BAD_VALUE')]);
        }

        if (isset($currentRequest->getPost()['componentOutput']) === false) {
            $currentRequest->import(['post' => $this->setInPost($currentRequest, 'componentOutput', 'BAD_VALUE')]);
        }

        if (isset($currentRequest->getPost()['componentPosition']) === false) {
            $currentRequest->import(['post' => $this->setInPost($currentRequest, 'componentPosition', 'BAD_VALUE')]);
        }

        return parent::do($currentRequest);
    }

}
