<?php

namespace UnitTests\classes\component\Template\UserInterface;

use DarlingCms\classes\component\Template\UserInterface\GenericUITemplate;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Template\UserInterface\GenericUITemplateTest as AbstractGenericUITemplateTest;

class GenericUITemplateTest extends AbstractGenericUITemplateTest
{
    public function setUp(): void
    {
        $this->setGenericUITemplate(
            new GenericUITemplate(
                new Storable(
                    'GenericUITemplateName',
                    'GenericUITemplateLocation',
                    'GenericUITemplateContainer'
                ),
                new Switchable(),
                new Positionable()
            )
        );
        $this->setGenericUITemplateParentTestInstances();
        $this->setPositionable($this->getGenericUITemplate());
    }
}
