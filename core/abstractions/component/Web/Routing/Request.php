<?php

namespace DarlingCms\abstractions\component\Web\Routing;

use DarlingCms\abstractions\component\SwitchableComponent;
use DarlingCms\interfaces\component\Web\Routing\Request as RequestInterface;
use DarlingCms\interfaces\primary\Storable;
use DarlingCms\interfaces\primary\Switchable;

abstract class Request extends SwitchableComponent implements RequestInterface
{
    private $url = '';
    private $get;
    private $post;

    public function __construct(Storable $storable, Switchable $switchable)
    {
        parent::__construct($storable, $switchable);
        $this->setUrl();
        $this->get = $_GET;
        $this->post = $_POST;
    }

    private function setUrl(): void
    {
        $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
    }

    public function getGet(): array
    {
        return ($this->getState() === false ? [] : $this->get);
    }

    public function getPost(): array
    {
        return ($this->getState() === false ? [] : $this->post);
    }

    public function getUrl(): string
    {
        return ($this->getState() === false
            ? '__DISABLED__'
            : ($this->url === 'http://' ? './' : $this->url)
        );
    }
}
