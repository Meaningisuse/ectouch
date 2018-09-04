<?php

namespace app\api\controller;

use app\http\controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->show('Api Page');
    }
}