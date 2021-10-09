<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
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
