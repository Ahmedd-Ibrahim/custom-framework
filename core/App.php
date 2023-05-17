<?php

use app\core\Application;

/*
* load env
*/
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$configration = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'username' => $_ENV['DB_USERNAME'],
        'password'=> $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__),
    $configration
);


return $app;
