<?php

/**
 * ECTouch - A Modern E-Commerce Platform
 *
 * @package  ECTouch
 * @homepage https://ectouch.cn
 */

// 检测PHP环境
if (version_compare(PHP_VERSION, '7.1.3', '<')) {
    die('require PHP > 7.1.3 !');
}

define('APPNAME', 'ECTouch');
define('VERSION', 'v3.0.0');
define('RELEASE', '20180808');
define('EC_CHARSET', 'utf-8');
define('ADMIN_PATH', 'admin');
define('AUTH_KEY', 'this is a key');
define('OLD_AUTH_KEY', '');
define('API_TIME', '');
define('APP_DEBUG', true);
define('BUILD_DIR_SECURE', false);
define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)) . '/');
define('APP_PATH', ROOT_PATH . 'app/');
define('CONF_PATH', ROOT_PATH . 'config/');
define('LANG_PATH', ROOT_PATH . 'resources/lang/');
define('RUNTIME_PATH', ROOT_PATH . 'storage/framework/');
require CONF_PATH . 'constant.php';
require APP_PATH . 'Kernel/Loader.php';
