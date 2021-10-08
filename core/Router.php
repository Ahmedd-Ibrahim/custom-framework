<?php

namespace app\core;

class Router
{
    protected array $routes = [];

    protected Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback == false) {

            Application::$app->response->setStatus(404);
            return "Not Found";
        }

        if(is_string($callback)) {
            return $this->renderView($callback);
        }

        if(is_array($callback)){
            $callback[0] = new $callback[0];
        }
        
        return call_user_func($callback);
    }

    public function renderView($view)
    {
        return include_once __DIR__ . "/../views/$view.php";
    }
}
