<?php

namespace DarlingCms\abstractions\component\Factory;

use DarlingCms\abstractions\component\Factory\StoredComponentFactory as CoreStoredComponentFactory;
use DarlingCms\interfaces\component\Factory\ResponseFactory as ResponseFactoryInterface;
use DarlingCms\interfaces\component\Factory\PrimaryFactory;
use DarlingCms\interfaces\component\Crud\ComponentCrud;
use DarlingCms\interfaces\component\Registry\Storage\StoredComponentRegistry;
use DarlingCms\interfaces\component\Component;
use DarlingCms\interfaces\component\Web\Routing\Response;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\classes\component\Web\Routing\Response as CoreResponse;
use DarlingCms\interfaces\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\interfaces\component\OutputComponent;

abstract class ResponseFactory extends CoreStoredComponentFactory implements ResponseFactoryInterface
{

    public function __construct(
        PrimaryFactory $primaryFactory,
        ComponentCrud $componentCrud,
        StoredComponentRegistry $storedComponentRegistry
    )
    {
        parent::__construct(
            $primaryFactory,
            $componentCrud,
            $storedComponentRegistry
        );
    }

    public function buildResponse(
        string $name,
        float $position,
        Component ...$requestsOutputComponentsStandardUITemplates
    ): Response
    {
        $response = new CoreResponse(
            $this->getPrimaryFactory()->buildStorable(
                $name,
                CoreResponse::RESPONSE_CONTAINER,
            ),
            $this->getPrimaryFactory()->buildSwitchable(),
            $this->getPrimaryFactory()->buildPositionable($position)
        );
        foreach($requestsOutputComponentsStandardUITemplates as $component)
        {
            if(
                in_array(
                    Request::class,
                    class_implements($component)
                ) === true
            ) {
                $response->addRequestStorageInfo($component);
            }
            if(
                in_array(
                    StandardUITemplate::class,
                    class_implements($component)
                ) === true
            ) {
                $response->addTemplateStorageInfo($component);
            }
            if(
                in_array(
                    OutputComponent::class,
                    class_implements($component)
                ) === true
            ) {
                $response->addOutputComponentStorageInfo($component);
            }
        }
        $this->storeAndRegister($response);
        return $response;
    }

}
