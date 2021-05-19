<?php

namespace UnitTests\interfaces\component\UserInterface\TestTraits;

use DarlingDataManagementSystem\interfaces\component\UserInterface\WebUI as WebUIInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Router as RouterInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\component\ResponseUI as ResponseUIInterface;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\classes\primary\Switchable as CoreSwitchable;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use RuntimeException as PHPRuntimeException;

trait WebUITestTrait
{

    private WebUIInterface $webUI;

    protected function setWebUIParentTestInstances(): void
    {
        $this->setResponseUI($this->getWebUI());
        $this->setResponseUIParentTestInstances();
    }

    public function getWebUI(): WebUIInterface
    {
        return $this->webUI;
    }

    public function setWebUI(WebUIInterface $webUI): void
    {
        $this->webUI = $webUI;
    }

    /**
     * @return array{0: StorableInterface, 1: SwitchableInterface, 2: PositionableInterface, 3: RouterInterface}
     */
    public function getWebUITestArgs(): array
    {
        return [
            new CoreStorable(
                'MockWebUIName',
                self::expectedAppLocation(),
                self::getTestComponentContainer()
            ),
            new CoreSwitchable(),
            new CorePositionable(),
            self::getRouter()
        ];
    }

    protected function expectedOutput(): string
    {
        return parent::expectedOutput();;
    }
}
