<?php

namespace App\Web\Controller;

use App\Kernel\Verify;

/**
 * 生成验证码
 * Class CaptchaController
 * @package App\Web\Controller
 */
class CaptchaController extends InitController
{
    public function index()
    {
        $verify = new Verify();
        $verify->length = 4;
        $verify->fontSize = 14;
        $verify->useCurve = false;

        $verify->entry();
    }
}
