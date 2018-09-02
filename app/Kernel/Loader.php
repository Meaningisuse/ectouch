<?php

// 记录开始运行时间
$GLOBALS['_beginTime'] = microtime(true);
// 记录内存初始使用
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if (MEMORY_LIMIT_ON) {
    $GLOBALS['_startUseMems'] = memory_get_usage();
}

// 版本信息
const KERNEL_VERSION = '3.2.3';

// URL 模式定义
const URL_COMMON   = 0; //普通模式
const URL_PATHINFO = 1; //PATHINFO模式
const URL_REWRITE  = 2; //REWRITE模式
const URL_COMPAT   = 3; // 兼容模式

// 类文件后缀
const EXT = '.php';

// 系统常量定义
defined('KERNEL_PATH') or define('KERNEL_PATH', __DIR__ . '/');
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
defined('APP_STATUS') or define('APP_STATUS', ''); // 应用状态 加载对应的配置文件
defined('APP_DEBUG') or define('APP_DEBUG', false); // 是否调试模式
defined('APP_MODE') or define('APP_MODE', 'common'); // 应用模式 默认为普通模式
defined('STORAGE_TYPE') or define('STORAGE_TYPE', 'File'); // 存储类型 默认为File
defined('RUNTIME_PATH') or define('RUNTIME_PATH', APP_PATH . 'Runtime/'); // 系统运行时目录
defined('SUPPORT_PATH') or define('SUPPORT_PATH', KERNEL_PATH . 'Support/'); // 系统应用模式目录
defined('COMMON_PATH') or define('COMMON_PATH', APP_PATH . 'Common/'); // 应用公共目录
defined('CONF_PATH') or define('CONF_PATH', COMMON_PATH . 'Config/'); // 应用配置目录
defined('LANG_PATH') or define('LANG_PATH', COMMON_PATH . 'Lang/'); // 应用语言目录
defined('HTML_PATH') or define('HTML_PATH', RUNTIME_PATH . 'Html/'); // 应用静态目录
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH . 'Logs/'); // 应用日志目录
defined('TEMP_PATH') or define('TEMP_PATH', RUNTIME_PATH . 'Temp/'); // 应用缓存目录
defined('DATA_PATH') or define('DATA_PATH', RUNTIME_PATH . 'Data/'); // 应用数据目录
defined('CACHE_PATH') or define('CACHE_PATH', RUNTIME_PATH . 'Cache/'); // 应用模板缓存目录
defined('CONF_EXT') or define('CONF_EXT', '.php'); // 配置文件后缀
defined('CONF_PARSE') or define('CONF_PARSE', ''); // 配置文件解析方法
defined('ADDON_PATH') or define('ADDON_PATH', APP_PATH . 'Addon');

// 系统信息
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    ini_set('magic_quotes_runtime', 0);
    define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc() ? true : false);
} else {
    define('MAGIC_QUOTES_GPC', false);
}
define('IS_CGI', (0 === strpos(PHP_SAPI, 'cgi') || false !== strpos(PHP_SAPI, 'fcgi')) ? 1 : 0);
define('IS_WIN', strstr(PHP_OS, 'WIN') ? 1 : 0);
define('IS_CLI', PHP_SAPI == 'cli' ? 1 : 0);

if (!IS_CLI) {
    // 当前文件名
    if (!defined('_PHP_FILE_')) {
        if (IS_CGI) {
            //CGI/FASTCGI模式下
            $_temp = explode('.php', $_SERVER['PHP_SELF']);
            define('_PHP_FILE_', rtrim(str_replace($_SERVER['HTTP_HOST'], '', $_temp[0] . '.php'), '/'));
        } else {
            define('_PHP_FILE_', rtrim($_SERVER['SCRIPT_NAME'], '/'));
        }
    }
    if (!defined('__ROOT__')) {
        $_root = rtrim(dirname(_PHP_FILE_), '/');
        define('__ROOT__', (('/' == $_root || '\\' == $_root) ? '' : $_root));
    }
}

// 加载核心类
require KERNEL_PATH . 'Kernel' . EXT;
// 核心类别名
class_alias('App\Kernel\Kernel', 'App');