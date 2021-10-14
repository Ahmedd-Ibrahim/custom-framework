<?php

use app\core\Router;
use app\controllers\SiteController;

Router::get('/', [SiteController::class, 'index']);
Router::get('/contact', [SiteController::class, 'show']);

Router::post('/contact', [SiteController::class, 'store']);

Router::get('/login', [AuthController::class, 'login']);

Router::post('/login', [AuthController::class, 'store']);

Router::get('/register', [AuthController::class, 'registerForm']);

Router::post('/register', [AuthController::class, 'register']);
