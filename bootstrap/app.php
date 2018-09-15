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
| Setting Application Path
|--------------------------------------------------------------------------
|
*/

define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)) . '/');
define('APP_PATH', ROOT_PATH . 'app/');
define('STORAGE_PATH', ROOT_PATH . 'storage/');
define('RESOURCE_PATH', ROOT_PATH . 'resources/');
define('RUNTIME_PATH', STORAGE_PATH . 'framework/');
define('COMMON_PATH', APP_PATH . 'Common/');
define('CONF_PATH', ROOT_PATH . 'config/');
define('LANG_PATH', RESOURCE_PATH . 'lang/');
define('TMPL_PATH', RESOURCE_PATH . 'views/');
define('HTML_PATH', RUNTIME_PATH . 'Html/');
define('LOG_PATH', STORAGE_PATH . 'logs/');
define('ADDON_PATH', APP_PATH . 'Addon');
define('CUSTOM_PATH', APP_PATH . 'Custom/');

/*
|--------------------------------------------------------------------------
| Loading Kernel
|--------------------------------------------------------------------------
|
*/

require APP_PATH . 'Kernel/Kernel.php';
