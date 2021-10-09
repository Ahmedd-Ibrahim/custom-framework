<?php

namespace app\core;

class Application
{
    public Router $router;

    public Request $request;

    public Response $response;

    public Database $database;

    public static Application $app;

    public static string $rootPath;

    public function __construct($rootPath, $configrationg) 
    {
        self::$app = $this;

        self::$rootPath = $rootPath;

        $this->request = new Request();

        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);

        $this->database = new Database($configrationg['db']);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
