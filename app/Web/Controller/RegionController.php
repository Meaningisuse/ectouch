<?php

namespace App\Web\Controller;


/**
 * 地区切换程序
 * Class RegionController
 * @package App\Web\Controller
 */
class RegionController extends InitController
{
    public function index()
    {
        header('Content-type: text/html; charset=' . CHARSET);

        $type = !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;
        $parent = !empty($_REQUEST['parent']) ? intval($_REQUEST['parent']) : 0;

        $arr['regions'] = get_regions($type, $parent);
        $arr['type'] = $type;
        $arr['target'] = !empty($_REQUEST['target']) ? stripslashes(trim($_REQUEST['target'])) : '';
        $arr['target'] = htmlspecialchars($arr['target']);

        return json_encode($arr);
    }
}
