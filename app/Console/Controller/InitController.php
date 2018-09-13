<?php

namespace App\Console\Controller;

use App\Libraries\Shop;
use App\Libraries\Error;
use App\Libraries\Mysql;
use App\Libraries\Template;
use App\Http\Controllers\Controller;

/**
 * 管理中心公用文件
 * Class InitController
 * @package App\Console\Controller
 */
class InitController extends Controller
{
    protected $ecs;
    protected $db;
    protected $err;
    protected $smarty;

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     * @throws \Exception
     */
    protected function initialize()
    {
        define('ECT_ADMIN', true);
        define('PHP_SELF', parse_name(request()->controller()) . '.php');

        $_REQUEST['act'] = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

        load_helper(['time', 'base', 'common']);
        load_helper(['main'], true);

        /* 创建 ECTouch 对象 */
        $GLOBALS['ecs'] = $this->ecs = new Shop();
        define('DATA_DIR', $GLOBALS['ecs']->data_dir());
        define('IMAGE_DIR', $GLOBALS['ecs']->image_dir());

        /* 初始化数据库类 */
        $GLOBALS['db'] = $this->db = new Mysql();

        /* 创建错误处理对象 */
        $GLOBALS['err'] = $this->err = new Error('message.htm');

        /* 载入系统参数 */
        $GLOBALS['_CFG'] = shop_config();

        load_lang(['common', 'log_action', basename(PHP_SELF, '.php')], 'admin');

        /* 创建 Smarty 对象。*/
        $GLOBALS['smarty'] = $this->smarty = new Template();

        $this->smarty->template_dir = MODULE_PATH . 'View';
        $this->smarty->compile_dir = storage_path('framework/views/admin');
        if (config('app.debug')) {
            $this->smarty->force_compile = true;
        }

        $this->smarty->assign('lang', $GLOBALS['_LANG']);
        $this->smarty->assign('help_open', $GLOBALS['_CFG']['help_open']);

        if (isset($GLOBALS['_CFG']['enable_order_check'])) {  // 为了从旧版本顺利升级到2.5.0
            $this->smarty->assign('enable_order_check', $GLOBALS['_CFG']['enable_order_check']);
        } else {
            $this->smarty->assign('enable_order_check', 0);
        }

        $this->smarty->assign('token', $GLOBALS['_CFG']['token']);

        return $this->checkAuth();
    }

    /**
     * 验证管理员身份
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    protected function checkAuth()
    {
        if ((!session('?admin_id') || session('admin_id') <= 0) &&
            $_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
            $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' && $_REQUEST['act'] != 'check_order') {
            /* session 不存在，检查cookie */
            if (!empty($_COOKIE['ECTCP']['admin_id']) && !empty($_COOKIE['ECTCP']['admin_pass'])) {
                // 找到了cookie, 验证cookie信息
                $sql = 'SELECT user_id, user_name, password, action_list, last_login ' .
                    ' FROM ' . $GLOBALS['ecs']->table('admin_user') .
                    " WHERE user_id = '" . intval($_COOKIE['ECTCP']['admin_id']) . "'";
                $row = $GLOBALS['db']->getRow($sql);

                if (!$row) {
                    // 没有找到这个记录
                    setcookie($_COOKIE['ECTCP']['admin_id'], '', 1);
                    setcookie($_COOKIE['ECTCP']['admin_pass'], '', 1);

                    if (!empty($_REQUEST['is_ajax'])) {
                        return make_json_error($GLOBALS['_LANG']['priv_error']);
                    } else {
                        return ecs_header("Location: privilege.php?act=login\n");
                    }
                } else {
                    // 检查密码是否正确
                    if (md5($row['password'] . $GLOBALS['_CFG']['hash_code']) == $_COOKIE['ECTCP']['admin_pass']) {
                        !isset($row['last_time']) && $row['last_time'] = '';
                        set_admin_session($row['user_id'], $row['user_name'], $row['action_list'], $row['last_time']);

                        // 更新最后登录时间和IP
                        $GLOBALS['db']->query('UPDATE ' . $GLOBALS['ecs']->table('admin_user') .
                            " SET last_login = '" . gmtime() . "', last_ip = '" . real_ip() . "'" .
                            " WHERE user_id = '" . session('admin_id') . "'");
                    } else {
                        setcookie($_COOKIE['ECTCP']['admin_id'], '', 1);
                        setcookie($_COOKIE['ECTCP']['admin_pass'], '', 1);

                        if (!empty($_REQUEST['is_ajax'])) {
                            return make_json_error($GLOBALS['_LANG']['priv_error']);
                        } else {
                            return ecs_header("Location: privilege.php?act=login\n");
                        }
                    }
                }
            } else {
                if (!empty($_REQUEST['is_ajax'])) {
                    return make_json_error($GLOBALS['_LANG']['priv_error']);
                } else {
                    return ecs_header("Location: privilege.php?act=login\n");
                }
            }
        }

        return $this->checkPriv();
    }

    /**
     * 访问权限检查
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|null
     */
    protected function checkPriv()
    {
        if ($_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
            $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' && $_REQUEST['act'] != 'check_order') {
            $admin_path = preg_replace('/:\d+/', '', $GLOBALS['ecs']->url()) . ADMIN_PATH;
            if (!empty($_SERVER['HTTP_REFERER']) &&
                strpos(preg_replace('/:\d+/', '', $_SERVER['HTTP_REFERER']), $admin_path) === false) {
                if (!empty($_REQUEST['is_ajax'])) {
                    return make_json_error($GLOBALS['_LANG']['priv_error']);
                } else {
                    return ecs_header("Location: privilege.php?act=login\n");
                }
            }
        }

        return null;
    }
}
