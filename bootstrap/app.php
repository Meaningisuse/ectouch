<?php

/**
 * ECTouch - A Modern E-Commerce Platform
 *
 * @package  ECTouch
 * @homepage https://ectouch.cn
 */

/*
|--------------------------------------------------------------------------
| 检测PHP环境
|--------------------------------------------------------------------------
|
*/

if (version_compare(PHP_VERSION, '7.1.3', '<')) {
    die('require PHP > 7.1.3 !');
}

/*
|--------------------------------------------------------------------------
| Setting Version
|--------------------------------------------------------------------------
|
*/

define('APPNAME', 'ECTouch');
define('VERSION', 'v3.0.0');
define('RELEASE', '20180808');
define('CHARSET', 'utf-8');

define('ADMIN_PATH', 'admin');
define('AUTH_KEY', 'this is a key');
define('OLD_AUTH_KEY', '');
define('API_TIME', '');

/*
|--------------------------------------------------------------------------
| Setting Debuger
|--------------------------------------------------------------------------
|
*/

if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    defined('APP_DEBUG') or define('APP_DEBUG', false);
} else {
    defined('APP_DEBUG') or define('APP_DEBUG', true);
}

/*
|--------------------------------------------------------------------------
| Loading Kernel
|--------------------------------------------------------------------------
|
*/

return think\Container::get('app')->path(dirname(__DIR__) . '/app/');
