<?php

namespace app\core;

class Database
{
    public array $config;

    public function __construct(array $config) {
        $this->config = $config;
        $this->connect();
    }

    public function connect()
    {
        return $pdo = new \PDO($this->config['dsn'], $this->config['username'], $this->config['password']);
    }
}
