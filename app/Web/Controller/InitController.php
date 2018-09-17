<?php

namespace App\Web\Controller;

use App\Libraries\Shop;
use App\Libraries\Error;
use App\Libraries\Mysql;
use App\Libraries\Template;
use App\Http\Controllers\Controller;

/**
 * Class InitController
 * @package App\Web\Controller
 */
class InitController extends Controller
{
    protected $ecs;
    protected $db;
    protected $err;
    protected $user;
    protected $smarty;

    protected function _initialize()
    {
        /**
         * 优先显示移动端页面
         */
        if ($this->isMobile()) {
            if (CONTROLLER_NAME != 'Index') {
                $this->redirect('/');
            }
            exit($this->fetch('drivers/mobile'));
        }

        define('PHP_SELF', parse_name(CONTROLLER_NAME) . '.php');

        load_helper(['time', 'base', 'common', 'main', 'insert', 'goods', 'article']);

        /* 创建 ECTouch 对象 */
        $GLOBALS['ecs'] = $this->ecs = new Shop();
        define('DATA_DIR', $this->ecs->data_dir());
        define('IMAGE_DIR', $this->ecs->image_dir());

        /* 初始化数据库类 */
        $GLOBALS['db'] = $this->db = new Mysql();

        /* 创建错误处理对象 */
        $GLOBALS['err'] = $this->err = new Error('message.dwt');

        /* 载入系统参数 */
        $GLOBALS['_CFG'] = shop_config();

        /* 载入语言文件 */
        load_lang('common');

        if ($GLOBALS['_CFG']['shop_closed'] == 1) {
            /* 商店关闭了，输出关闭的消息 */
            header('Content-type: text/html; charset=' . CHARSET);

            die('<div style="margin: 150px; text-align: center; font-size: 14px"><p>' . $GLOBALS['_LANG']['shop_closed'] . '</p><p>' . $GLOBALS['_CFG']['close_comment'] . '</p></div>');
        }

        if (is_spider()) {
            /* 如果是蜘蛛的访问，那么默认为访客方式，并且不记录到日志中 */
            if (!defined('INIT_NO_USERS')) {
                define('INIT_NO_USERS', true);
                /* 整合UC后，如果是蜘蛛访问，初始化UC需要的常量 */
                if ($GLOBALS['_CFG']['integrate_code'] == 'ucenter') {
                    $GLOBALS['user'] = $this->user = &init_users();
                }
            }

            session('user_id', 0);
            session('user_name', '');
            session('email', '');
            session('user_rank', 0);
            session('discount', 1.00);
        }

        if (!defined('INIT_NO_USERS')) {
            define('SESS_ID', session_id());
        }
        if (isset($_SERVER['PHP_SELF'])) {
            $_SERVER['PHP_SELF'] = htmlspecialchars($_SERVER['PHP_SELF']);
        }
        if (!defined('INIT_NO_SMARTY')) {
            header('Cache-control: private');
            header('Content-type: text/html; charset=' . CHARSET);

            /* 创建 Smarty 对象。*/
            $GLOBALS['smarty'] = $this->smarty = new Template();

            $this->smarty->cache_lifetime = $GLOBALS['_CFG']['cache_time'];
            $this->smarty->template_dir = resource_path('views/' . $GLOBALS['_CFG']['template']);
            $this->smarty->cache_dir = storage_path('framework/cache');
            $this->smarty->compile_dir = storage_path('framework/views');

            if (config('app.debug')) {
                $this->smarty->direct_output = true;
                $this->smarty->force_compile = true;
            } else {
                $this->smarty->direct_output = false;
                $this->smarty->force_compile = false;
            }

            $this->smarty->assign('lang', $GLOBALS['_LANG']);
            $this->smarty->assign('ecs_charset', CHARSET);
            if (!empty($GLOBALS['_CFG']['stylename'])) {
                $css_path = 'themes/' . $GLOBALS['_CFG']['template'] . '/style_' . $GLOBALS['_CFG']['stylename'] . '.css';
            } else {
                $css_path = 'themes/' . $GLOBALS['_CFG']['template'] . '/style.css';
            }
            $this->smarty->assign('css_path', asset($css_path));
        }

        if (!defined('INIT_NO_USERS')) {
            /* 会员信息 */
            $GLOBALS['user'] = $this->user =& init_users();

            if (!session('?user_id')) {
                /* 获取投放站点的名称 */
                $site_name = isset($_GET['from']) ? htmlspecialchars($_GET['from']) : addslashes($GLOBALS['_LANG']['self_site']);
                $from_ad = !empty($_GET['ad_id']) ? intval($_GET['ad_id']) : 0;

                session('from_ad', $from_ad); // 用户点击的广告ID
                session('referer', stripslashes($site_name)); // 用户来源

                unset($site_name);

                if (!defined('INGORE_VISIT_STATS')) {
                    visit_stats();
                }
            }

            if (empty(session('user_id'))) {
                if ($this->user->get_cookie()) {
                    /* 如果会员已经登录并且还没有获得会员的帐户余额、积分以及优惠券 */
                    if (session('user_id') > 0) {
                        update_user_info();
                    }
                } else {
                    session('user_id', 0);
                    session('user_name', '');
                    session('email', '');
                    session('user_rank', 0);
                    session('discount', 1.00);
                    if (!session('?login_fail')) {
                        session('login_fail', 0);
                    }
                }
            }

            /* 设置推荐会员 */
            if (isset($_GET['u'])) {
                set_affiliate();
            }

            /* session 不存在，检查cookie */
            if (!empty($_COOKIE['ECT']['user_id']) && !empty($_COOKIE['ECT']['password'])) {
                // 找到了cookie, 验证cookie信息
                $sql = 'SELECT user_id, user_name, password ' .
                    ' FROM ' . $this->ecs->table('users') .
                    " WHERE user_id = '" . intval($_COOKIE['ECT']['user_id']) . "' AND password = '" . $_COOKIE['ECT']['password'] . "'";

                $row = $this->db->getRow($sql);

                if (!$row) {
                    // 没有找到这个记录
                    $time = time() - 3600;
                    cookie("ECT[user_id]", '', $time);
                    cookie("ECT[password]", '', $time);
                } else {
                    session('user_id', $row['user_id']);
                    session('user_name', $row['user_name']);
                    update_user_info();
                }
            }
        }
    }

    /**
     * 判断是否为移动设备
     * @return bool
     */
    protected function isMobile()
    {
        $detect = new \Mobile_Detect();

        // Any mobile device (phones or tablets).
        return $detect->isMobile();
    }
}
