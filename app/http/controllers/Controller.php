<?php

namespace app\http\controllers;

use app\services\JWTService;
use app\services\ResponseService;
use think\Controller as BaseController;

class Controller extends BaseController
{
    use ResponseService, JWTService;
}