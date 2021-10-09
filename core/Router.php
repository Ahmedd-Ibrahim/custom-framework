<?php

namespace app\core;

class Router
{
    protected array $routes = [];

    protected Request $request;

    protected Response $response;

    public function __construct(Request $request, $response) {
        $this->request  = $request;
        $this->response = $response;
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
        $method = $this->request->method();
        $path = $this->request->getPath();
        $callback = $this->routes[$method][$path] ?? false;

        if($callback == false) {
            $this->response->setStatus(404);
            return "Not Found";
        }

        if(is_string($callback)) {
            return $this->renderView($callback, []);
        }

        if(is_array($callback)){
            $callback[0] = new $callback[0];
        }
        
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$rootPath. "/views/$view.php";
        return ob_get_clean();
    }

}
