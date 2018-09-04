<?php

namespace app\api\controller;

use app\http\controllers\Controller;

class PassportController extends Controller
{

    public function login()
    {
        echo ' login';
    }

    public function register()
    {
        echo 'register';
    }

    public function fastLogin()
    {
        return $this->succeed(['foo' => 'bar']);
    }

}
