<?php


require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;




$app = require_once __DIR__ . '/../core/App.php';

$app->router->get('/contact', [SiteController::class, 'show']);
$app->router->post('/contact', [SiteController::class, 'store']);
$app->router->get('/', 'home');


$app->router->get('/login', [AuthController::class, 'login']);

$app->router->post('/login', [AuthController::class, 'store']);

$app->router->get('/register', [AuthController::class, 'registerForm']);
$app->router->post('/register', [AuthController::class, 'register']);

$run = $app->run();
