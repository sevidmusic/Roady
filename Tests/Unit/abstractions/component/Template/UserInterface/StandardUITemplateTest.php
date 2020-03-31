<?php

namespace UnitTests\abstractions\component\Template\UserInterface;

use DarlingCms\classes\primary\Positionable;
use DarlingCms\classes\primary\Storable;
use DarlingCms\classes\primary\Switchable;
use UnitTests\abstractions\component\SwitchableComponentTest;
use UnitTests\interfaces\component\Template\UserInterface\TestTraits\StandardUITemplateTestTrait;
use UnitTests\interfaces\primary\TestTraits\PositionableTestTrait;

class StandardUITemplateTest extends SwitchableComponentTest
{
    use StandardUITemplateTestTrait;
    use PositionableTestTrait;

    public function setUp(): void
    {
        $this->setGenericUITemplate(
            $this->getMockForAbstractClass(
                '\DarlingCms\abstractions\component\Template\UserInterface\StandardUITemplate',
                [
                    new Storable(
                        'MockGenericUITemplateName',
                        'MockGenericUITemplateLocation',
                        'MockGenericUITemplateContainer'
                    ),
                    new Switchable(),
                    new Positionable()
                ]
            )
        );
        $this->setGenericUITemplateParentTestInstances();
        $this->setPositionable($this->getGenericUITemplate());
    }

}
