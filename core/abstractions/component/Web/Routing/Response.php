<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as StandardStorable;
use DarlingDataManagementSystem\interfaces\component\Component;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud;
use DarlingDataManagementSystem\interfaces\component\OutputComponent;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as Template;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable;
use DarlingDataManagementSystem\interfaces\primary\Storable;
use DarlingDataManagementSystem\interfaces\primary\Switchable;

abstract class Response extends SwitchableComponent implements ResponseInterface
{

    private $outputComponentStorageInfo = array();
    private $templateStorageInfo = array();
    private $requestStorageInfo = array();
    private $positionable;

    public function __construct(Storable $storable, Switchable $switchable, Positionable $positionable = null)
    {
        $this->positionable = (empty($positionable) === true ? new CorePositionable(0) : $positionable);
        $st = new StandardStorable(
            $storable->getName(),
            $storable->getLocation(),
            self::RESPONSE_CONTAINER
        );
        parent::__construct($st, $switchable);
    }

    public function respondsToRequest(Request $request, ComponentCrud $crud): bool
    {
        foreach ($this->getRequestStorageInfo() as $storable) {
            $storedRequest = $crud->read($storable);
            if ($this->isARequest($storedRequest) === false) {
                continue;
            }
            if ($request->getUrl() === $storedRequest->getUrl()) {
                return true;
            }
        }
        return false;
    }

    public function getRequestStorageInfo(): array
    {
        return ($this->getState() === false ? [] : $this->requestStorageInfo);
    }

    private function isARequest(Component $component): bool
    {
        return (
        in_array('DarlingDataManagementSystem\interfaces\component\Web\Routing\Request', class_implements($component)) === false
            ? false
            : true
        );
    }

    public function addOutputComponentStorageInfo(OutputComponent $outputComponent): bool
    {
        $initialCount = count($this->outputComponentStorageInfo);
        array_push($this->outputComponentStorageInfo, $outputComponent->export()['storable']);
        return (count($this->outputComponentStorageInfo) > $initialCount);
    }

    public function removeOutputComponentStorageInfo(string $nameOrId): bool
    {
        $initialCount = count($this->outputComponentStorageInfo);
        foreach ($this->outputComponentStorageInfo as $key => $storable) {
            if ($storable->getUniqueId() === $nameOrId || $storable->getName() === $nameOrId) {
                unset($this->outputComponentStorageInfo[$key]);
                return (count($this->outputComponentStorageInfo) < $initialCount);
            }
        }
        return false;
    }

    public function addRequestStorageInfo(Request $request): bool
    {
        $initialCount = count($this->requestStorageInfo);
        array_push(
            $this->requestStorageInfo,
            $request->export()['storable']
        );
        return (count($this->requestStorageInfo) > $initialCount);
    }

    public function getOutputComponentStorageInfo(): array
    {
        return ($this->getState() === false ? [] : $this->outputComponentStorageInfo);
    }

    public function addTemplateStorageInfo(Template $template): bool
    {
        $initialCount = count($this->templateStorageInfo);
        array_push($this->templateStorageInfo, $template->export()['storable']);
        return (count($this->templateStorageInfo) > $initialCount);
    }

    public function removeTemplateStorageInfo(string $nameOrId): bool
    {
        $initialCount = count($this->templateStorageInfo);
        foreach ($this->templateStorageInfo as $key => $storable) {
            if ($storable->getUniqueId() === $nameOrId || $storable->getName() === $nameOrId) {
                unset($this->templateStorageInfo[$key]);
                return (count($this->templateStorageInfo) < $initialCount);
            }
        }
        return false;

    }

    public function removeRequestStorageInfo(string $nameOrId): bool
    {
        $initialCount = count($this->requestStorageInfo);
        foreach ($this->requestStorageInfo as $key => $storable) {
            if ($storable->getUniqueId() === $nameOrId || $storable->getName() === $nameOrId) {
                unset($this->requestStorageInfo[$key]);
                return (count($this->requestStorageInfo) < $initialCount);
            }
        }
        return false;

    }

    public function getTemplateStorageInfo(): array
    {
        return ($this->getState() === false ? [] : $this->templateStorageInfo);
    }

    public function increasePosition(): bool
    {
        return $this->positionable->increasePosition();
    }

    public function decreasePosition(): bool
    {
        return $this->positionable->decreasePosition();
    }

    public function getPosition(): float
    {
        return $this->positionable->getPosition();
    }

}

