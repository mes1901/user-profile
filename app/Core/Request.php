<?php

declare(strict_types=1);

class Request
{
    /**
     * @var string
     * @var string
     * @var string
     * @var array
     */
    private $url;
    private $controller;
    private $action;
    private $params = [];

    /**
     * Filter url path and initialize it.
     */
    public function __construct()
    {
        $this->url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $this->init();
    }

    /**
     * Separate url to define controller, action and params.
     * Set default controller and action.
     */
    private function init(): void
    {
        if ($this->url !== '/') {
            $prepareUri = explode('/', trim($this->url, '/'));
            $this->controller = ucfirst(array_shift($prepareUri)) . 'Controller';
            $this->action = array_shift($prepareUri) . 'Action';
            $this->params = $prepareUri;
        } else {
            $this->controller = 'UserController';
            $this->action = 'profileAction';
        }
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}