<?php

namespace App\Api\Controller;

use App\Common\Controller\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->show('Api Page');
    }
}