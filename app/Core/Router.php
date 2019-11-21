<?php

declare(strict_types=1);

class Router
{
    /**
     * The request we're working with.
     * @var string
     */
    public $request;

    /**
     * For this example, the constructor will be responsible
     * for parsing the request.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Run the router. Checking the existence of the controller and make instance of it.
     * Checking the existence of the method in controller.
     * Launch callback function with current parameters.
     * @return mixed
     */
    public function run(): void
    {
        $controller = $this->request->getController();
        $action = $this->request->getAction();
        $params = $this->request->getParams();

        $controllerPath = ROOT . '/app/Controllers/' . $controller . '.php';
        if (!file_exists($controllerPath)) {
            $this->errorPage();
        }

        include_once $controllerPath;
        $createController = new $controller;

        if (!method_exists($createController, $action)) {
            $this->errorPage();
        }

        call_user_func_array([$createController, $action], $params);
    }

    /**
     * Rendering error page
     * @return mixed
     */
    public function errorPage(): void
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}
