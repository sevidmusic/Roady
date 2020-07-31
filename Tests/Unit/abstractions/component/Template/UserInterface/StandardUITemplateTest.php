<?php

namespace UnitTests\abstractions\component\Template\UserInterface;

use DarlingDataManagementSystem\classes\primary\Positionable;
use DarlingDataManagementSystem\classes\primary\Storable;
use DarlingDataManagementSystem\classes\primary\Switchable;
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
                '\DarlingDataManagementSystem\abstractions\component\Template\UserInterface\StandardUITemplate',
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
