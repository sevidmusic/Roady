<?php

namespace UnitTests\classes\component\Template\UserInterface;

use DarlingCms\classes\component\Template\UserInterface\StandardUITemplate;
use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\Template\UserInterface\StandardUITemplateTest as AbstractGenericUITemplateTest;

class StandardUITemplateTest extends AbstractGenericUITemplateTest
{
    public function setUp(): void
    {
        $this->setGenericUITemplate(
            new StandardUITemplate(
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
