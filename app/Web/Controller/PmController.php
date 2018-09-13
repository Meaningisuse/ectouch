<?php

namespace app\web\controller;

/**
 * Class PmController
 * @package app\web\controller
 */
class PmController extends InitController
{
    public function index()
    {
        if (empty(session('user_id')) || $GLOBALS['_CFG']['integrate_code'] == 'ectouch') {
            return ecs_header('Location:./');
        }

        uc_call("uc_pm_location", [session('user_id')]);
    }
}
