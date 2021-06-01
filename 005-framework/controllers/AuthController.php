<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $this->render('login');
    }

    public function register(Request $request)
    {
        $this->render('register');
    }

}