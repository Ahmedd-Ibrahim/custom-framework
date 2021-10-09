<?php


require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;


$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$configration = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'username' => $_ENV['DB_USERNAME'],
        'password'=> $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $configration);

$app->router->get('/contact', [SiteController::class, 'show']);
$app->router->post('/contact', [SiteController::class, 'store']);
$app->router->get('/', 'home');


$app->router->get('/login', [AuthController::class, 'login']);

$app->router->post('/login', [AuthController::class, 'store']);

$app->router->get('/register', [AuthController::class, 'registerForm']);
$app->router->post('/register', [AuthController::class, 'register']);

$run = $app->run();
