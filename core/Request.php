<?php

namespace app\core;

class Request
{
    public const GET = 'get';
    public const POST = 'get';

    public function __construct()
    {
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
        return $this->method() == self::GET;
    }

    /**
     * check request post method
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->method() == self::POST;
    }

    /**
     * method to get request body
     *
     * @return array
     */
    public function getBody()
    {
        $body = [];
        $request = $this->method() == self::GET
            ? $_GET
            : $_POST;

        foreach ($request as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    private function assignProperties()
    {
        foreach ($_REQUEST as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
