<?php

namespace App\Custom\Test\Controller;

use App\Http\Controllers\Controller;

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