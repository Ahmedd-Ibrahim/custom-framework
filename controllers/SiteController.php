<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return $this->render('home');
    }

    public function show()
    {
        $name = ['name' => 'Ahmed'];

        return $this->render('contact', $name);
    }

    public function store(Request $request)
    {
        return $request->getBody();
    }
}
