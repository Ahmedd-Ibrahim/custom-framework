<?php

namespace app\core;

class Controller
{
    public function render($view, array $prams = [])
    {
        return Application::$app->router->renderView($view, $prams);
    }
}
