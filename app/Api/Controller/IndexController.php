<?php

namespace App\Api\Controller;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->show('Api Page');
    }
}