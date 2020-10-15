<?php

namespace UnitTests\abstractions\component\UserInterface;

use UnitTests\abstractions\component\OutputComponentTest as CoreOutputComponentTest;
use UnitTests\interfaces\component\UserInterface\TestTraits\StandardUITestTrait;

class StandardUITest extends CoreOutputComponentTest
{
    use StandardUITestTrait;

    public function setUp(): void
    {
        $this->setStandardUI(
            $this->getMockForAbstractClass(
                '\DarlingDataManagementSystem\abstractions\component\UserInterface\StandardUI',
                $this->getTestInstanceArgs()
            )
        );
        $this->setStandardUIParentTestInstances();
        $this->generateStoredTestComponents();
    }

}
