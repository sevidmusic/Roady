<?php

namespace roady\abstractions\component\Web\Routing;

use roady\abstractions\component\SwitchableComponent as SwitchableComponentBase;
use roady\interfaces\component\Web\Routing\Request as RequestInterface;
use roady\interfaces\primary\Storable as StorableInterface;
use roady\interfaces\primary\Switchable as SwitchableInterface;

abstract class Request extends SwitchableComponentBase implements RequestInterface
{
    private string $url = '';

    /**
     * @var array<mixed> $get
     */
    private array $get;

    /**
     * @var array<mixed> $post
     */
    private array $post;

    public function __construct(StorableInterface $storable, SwitchableInterface $switchable)
    {
        parent::__construct($storable, $switchable);
        $this->setUrl();
        $this->get = $_GET;
        $this->post = $_POST;
    }

    private function setUrl(): void
    {
        $this->url = (
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                ? 'https'
                : 'http'
            ) . '://' . (
                $_SERVER['HTTP_HOST'] ?? ''
            ) . (
                $_SERVER['REQUEST_URI'] ?? ''
            );
    }

    /**
     * @return array<mixed>
     */
    public function getGet(): array
    {
        return ($this->getState() === false ? [] : $this->get);
    }

    /**
     * @return array<mixed>
     */
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
