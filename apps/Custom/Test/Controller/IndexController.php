<?php

namespace app\custom\demo\controller;

use app\http\controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->show('Custom Page');
    }

    public function view()
    {
        $this->display();
    }
}