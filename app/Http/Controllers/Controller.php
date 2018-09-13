<?php

namespace App\Http\Controllers;

use App\Services\JWTService;
use App\Services\ResponseService;
use Think\Controller\RestController as BaseController;

class Controller extends BaseController
{
    use ResponseService, JWTService;
}
