<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return $this->render('login');
    }

    public function registerForm()
    {
        return $this->render('register');
    }

    public function register(Request $request)
    {
        return $request->getBody();
    }


    public function store(Request $request)
    {
        return $request->password;
    }
}
