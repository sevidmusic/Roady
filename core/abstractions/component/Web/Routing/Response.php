<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\abstractions\component\SwitchableComponent;
use DarlingCms\interfaces\component\OutputComponent;
use DarlingCms\interfaces\component\Web\Routing\Request;
use DarlingCms\interfaces\component\Web\Routing\Response as ResponseInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class Response extends SwitchableComponent implements ResponseInterface
{

    private $requests = array();
    private $outputComponentStorageInfo = array();

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
    }

    public function addRequest(Request $request): bool
    {
        $initialCount = count($this->requests);
        array_push($this->requests, $request);
        return (count($this->requests) > $initialCount);
    }

    public function removeRequest(string $nameOrId): bool
    {
        $initialCount = count($this->requests);
        foreach ($this->requests as $key => $request) {
            if ($request->getUniqueId() === $nameOrId || $request->getName() === $nameOrId) {
                unset($this->requests[$key]);
                return (count($this->requests) < $initialCount);
            }
        }
        return false;
    }

    public function respondsToRequest(Request $request): bool
    {
        foreach ($this->requests as $assignedRequest) {
            if (
                $request->getGet() === $assignedRequest->getGet()
                &&
                $request->getPost() === $assignedRequest->getPost()
                &&
                $request->getUrl() === $assignedRequest->getUrl()
            ) {
                return true;
            }
        }
        return false;
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

    public function getOutputComponentStorageInfo(): array
    {
        return $this->outputComponentStorageInfo;
    }

}

