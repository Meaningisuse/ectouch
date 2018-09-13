<?php

namespace App\Console\Controller;

/**
 *  帮助信息接口
 */
class HelpController extends InitController
{
    public function index()
    {
        $get_keyword = trim($_GET['al']); // 获取关键字
        header("location:http://help.ectouch.cn/do.php?k=" . $get_keyword . "&v=" . $GLOBALS['_CFG']['ecs_version'] . "&l=" . $GLOBALS['_CFG']['lang'] . "&c=" . CHARSET);
    }
}
