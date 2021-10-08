<?php


require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;

$app = new Application();

$app->router->get('/contact', [SiteController::class, 'show']);
$app->router->get('/', 'home');

$run = $app->run();
