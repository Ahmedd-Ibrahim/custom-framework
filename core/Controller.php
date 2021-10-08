<?php

namespace app\core;

class Controller
{
    public function render()
    {
        return Application::$app->router->renderView('contact');
    }
}
