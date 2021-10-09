<?php

namespace app\core;

class Request
{

    /**
     * constructort of the request class
     * @return void
     */
    public function __construct() {
        $this->assignProperties();
    }

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
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * check request get method
     * 
     * @return bool
     */
    public function isGet()
    {
        return $this->method() == 'get';
    }

    /**
     * check request post method
     * 
     * @return bool
     */
    public function isPost()
    {
        return $this->method() == 'post';
    }

    /**
     * method to get request body
     * 
     * @return array
     */
    public function getBody()
    {
        $body = [];
        if($this->method() == 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->method() == 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    public function assignProperties()
    {
        foreach ($_REQUEST as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
