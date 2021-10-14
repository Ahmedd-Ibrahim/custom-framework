<?php

namespace app\core;

class Router
{
    protected array $routes = [];

    protected Request $request;

    protected Response $response;

    public static Router $router;

    public function __construct(Request $request, $response) {
        
        self::$router = $this;

        $this->request  = $request;

        $this->response = $response;

        $this->routesFiles();
    }

   public static function __callStatic($name, $arguments)
   {
       if ($name == 'get'){
        call_user_func([self::$router, 'getMethod'], $arguments[0], $arguments[1]);
       }

       if ($name == 'post'){
        call_user_func([self::$router, 'postMethod'], $arguments[0], $arguments[1]);
       }
   }

    /**
     * @return false|mixed|string|void
     */
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
    
    /**
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function renderView($view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$rootPath. "/views/$view.php";
        return ob_get_clean();
    }


    /**
     * @param $path
     * @param $callback
     * @return void
     */
    private function getMethod($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    private function postMethod($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * include route files
     */
    private function routesFiles()
    {
        $routeFiles = dirname(__DIR__) .'/routes';
        $filterFiles = array_filter(scandir($routeFiles), fn ($file) => str_ends_with($file, '.php'));

        foreach ($filterFiles as $key => $value) {
            include_once __DIR__ . '/../routes/'. $value;
        }
    }
}