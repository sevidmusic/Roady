<?php

namespace DarlingDataManagementSystem\abstractions\component\Web\Routing;

use DarlingDataManagementSystem\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use DarlingDataManagementSystem\classes\primary\Positionable as CorePositionable;
use DarlingDataManagementSystem\classes\primary\Storable as CoreStorable;
use DarlingDataManagementSystem\interfaces\component\Component as ComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Crud\ComponentCrud as ComponentCrudInterface;
use DarlingDataManagementSystem\interfaces\component\OutputComponent as OutputComponentInterface;
use DarlingDataManagementSystem\interfaces\component\Template\UserInterface\StandardUITemplate as StandardUITemplateInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingDataManagementSystem\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingDataManagementSystem\interfaces\primary\Positionable as PositionableInterface;
use DarlingDataManagementSystem\interfaces\primary\Storable as StorableInterface;
use DarlingDataManagementSystem\interfaces\primary\Switchable as SwitchableInterface;

abstract class Response extends SwitchableComponentBase implements ResponseInterface
{

    /**
     * @var array<int, StorableInterface> $outputComponentStorageInfo
     */
    private array $outputComponentStorageInfo = array();

    /**
     * @var array<int, StorableInterface> $templateStorageInfo
     */
    private array  $templateStorageInfo = array();

    /**
     * @var array<int, StorableInterface> $requestStorageInfo
     */
    private array  $requestStorageInfo = array();
    private PositionableInterface  $positionable;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable, PositionableInterface $positionable = null)
    {
        $this->positionable = (empty($positionable) === true ? new CorePositionable(0) : $positionable);
        $st = new CoreStorable(
            $storable->getName(),
            $storable->getLocation(),
            self::RESPONSE_CONTAINER
        );
        parent::__construct($st, $switchable);
    }

    public function respondsToRequest(RequestInterface $request, ComponentCrudInterface $crud): bool
    {
        foreach ($this->getRequestStorageInfo() as $storable) {
            $storedRequest = $crud->read($storable);
            if ($this->isARequest($storedRequest) === false) {
                continue;
            }
            /**
             * @var RequestInterface $storedRequest
             */
            if ($request->getUrl() === $storedRequest->getUrl()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array<int, StorableInterface>
     */
    public function getRequestStorageInfo(): array
    {
        return ($this->getState() === false ? [] : $this->requestStorageInfo);
    }

    private function isARequest(ComponentInterface $component): bool
    {
        $classImplements = class_implements($component);
        return (
            in_array(
                'DarlingDataManagementSystem\interfaces\component\Web\Routing\Request',
                (is_array($classImplements) ? $classImplements : [])
            ) === false
            ? false
            : true
        );
    }

    public function addOutputComponentStorageInfo(OutputComponentInterface $outputComponent): bool
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

    public function addRequestStorageInfo(RequestInterface $request): bool
    {
        $initialCount = count($this->requestStorageInfo);
        array_push(
            $this->requestStorageInfo,
            $request->export()['storable']
        );
        return (count($this->requestStorageInfo) > $initialCount);
    }

    /**
     * @return array<int, StorableInterface>
     */
    public function getOutputComponentStorageInfo(): array
    {
        return ($this->getState() === false ? [] : $this->outputComponentStorageInfo);
    }

    public function addTemplateStorageInfo(StandardUITemplateInterface $template): bool
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

    /**
     * @return array<int, StorableInterface>
     */
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

