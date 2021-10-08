<?php

namespace app\core;

class Request
{

    /**
     * get route path
     * 
     * @return string
     */
    public function getPath()
    {
        return $_SERVER['PATH_INFO'] ?? '/';
    }

    /**
     * get request method
     * 
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
