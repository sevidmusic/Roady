<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;
use DarlingCms\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingCms\abstractions\component\SwitchableComponent;

abstract class Request extends SwitchableComponent implements RequestInterface
{
    private $url = '';

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
        $this->setUrl();
    }

    public function getGet(): array
    {
        return $_GET;
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getUrl(): string
    {
        return ($this->url === 'http://' ? './' : $this->url);
    }

    private function setUrl(): void
    {
        $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
    }
}
