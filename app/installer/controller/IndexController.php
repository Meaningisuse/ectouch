<?php

namespace app\installer\controller;

use app\http\controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return 'installer.';
    }
}
