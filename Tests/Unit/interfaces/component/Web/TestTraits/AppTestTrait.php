<?php

namespace UnitTests\interfaces\component\Web\TestTraits;

use DarlingCms\interfaces\component\Web\App;

trait AppTestTrait
{

    private $app;

    protected function setAppParentTestInstances(): void
    {
        $this->setSwitchableComponent($this->getApp());
        $this->setSwitchableComponentParentTestInstances();
    }

    protected function getApp(): App
    {
        return $this->app;
    }

    protected function setApp(App $app): void
    {
        $this->app = $app;
    }

}