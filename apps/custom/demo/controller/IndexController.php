<?php

namespace App\Custom\Demo\Controller;

use App\Common\Controller\Controller;

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