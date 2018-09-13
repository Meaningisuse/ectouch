<?php

/**
 * 应用根目录
 * @param string $path
 * @return string
 */
function base_path($path = '')
{
    return dirname(dirname(__DIR__)) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * 应用核心目录
 * @param string $path
 * @return string
 */
function app_path($path = '')
{
    return base_path('app' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 应用配置目录
 * @param string $path
 * @return string
 */
function config_path($path = '')
{
    return base_path('config' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 应用数据库目录
 * @param string $path
 * @return string
 */
function database_path($path = '')
{
    return base_path('database' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 入口文件目录
 * @param string $path
 * @return string
 */
function public_path($path = '')
{
    return base_path('public' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 资源文件目录
 * @param string $path
 * @return string
 */
function resource_path($path = '')
{
    return base_path('resources' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 文件存储目录
 * @param string $path
 * @return string
 */
function storage_path($path = '')
{
    return base_path('storage' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 插件目录
 * @param string $path
 * @return string
 */
function plugin_path($path = '')
{
    return app_path('modules' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}

/**
 * 兼容 I 方法
 * @param $name
 * @param string $default
 * @param null $filter
 * @param null $data
 * @return mixed
 */
function input($name, $default = '', $filter = null, $data = null)
{
    return I($name, $default, $filter, $data);
}

/**
 * 兼容 C 方法
 * @param null $name
 * @param null $value
 * @param null $default
 * @return mixed
 */
function config($name = null, $value = null, $default = null)
{
    return C($name, $value, $default);
}

/**
 * 兼容 S 方法
 * @param $name
 * @param string $value
 * @param null $options
 * @return mixed
 */
function cache($name, $value = '', $options = null)
{
    return S($name, $value, $options);
}

/**
 * 兼容 W 方法
 * @param $name
 * @param array $data
 */
function widget($name, $data = array())
{
    return W($name, $data);
}

/**
 * 兼容 F 方法
 * @param $name
 * @param string $value
 * @param string $path
 * @return mixed
 */
function storage($name, $value = '', $path = DATA_PATH)
{
    return F($name, $value, $path);
}

/**
 * @param $msg
 * @param int $code
 * @throws \Think\Exception
 */
function exception($msg, $code = 0)
{
    return E($msg, $code);
}

/**
 * @param null $name
 * @param null $value
 * @return mixed
 */
function lang($name = null, $value = null)
{
    return L($name, $value);
}

/**
 * @param string $template
 * @param string $layer
 * @return string
 */
function view($template = '', $layer = '')
{
    return T($template, $layer);
}

/**
 * @param $name
 * @param string $layer
 * @param int $level
 * @return false|\Think\Controller
 */
function action($name, $layer = '', $level = 0)
{
    return A($name, $layer, $level);
}

/**
 * @param $url
 * @param array $vars
 * @param string $layer
 * @return mixed
 */
function rpc($url, $vars = array(), $layer = '')
{
    return R($url, $vars, $layer);
}

/**
 * @param $name
 * @param string $tag
 * @param null $params
 */
function behavior($name, $tag = '', &$params = null)
{
    return B($name, $tag, $params);
}

/**
 * 兼容 U 方法
 * @param string $url
 * @param string $vars
 * @param bool $suffix
 * @param bool $domain
 * @return string
 */
function url($url = '', $vars = '', $suffix = true, $domain = false)
{
    return U($url, $vars, $suffix, $domain);
}

/**
 * 兼容 D 方法
 * @param string $name
 * @param string $layer
 * @return \Think\Model
 */
function model($name = '', $layer = '')
{
    return D($name, $layer);
}

/**
 * 兼容 M 方法
 * @param string $name
 * @param string $tablePrefix
 * @param string $connection
 * @return \Think\Model
 */
function dao($name = '', $tablePrefix = '', $connection = '')
{
    return M($name, $tablePrefix, $connection);
}

/**
 * 兼容 dump 方法
 * @param $var
 * @param bool $echo
 * @param null $label
 * @param bool $strict
 * @return string|void
 */
function dd($var, $echo = true, $label = null, $strict = true)
{
    return dump($var, $echo, $label, $strict);
}

/**
 * 静态资源URL
 * @param null $path
 * @return string
 */
function asset($path = null)
{
    $path = is_null($path) ? '' : trim($path, '/');

    return __ROOT__ . '/' . $path;
}

/**
 * 加载函数库
 * @param array $files
 * @param bool $submodule
 */
function load_helper($files = [], $submodule = false)
{
    if (!is_array($files)) {
        $files = [$files];
    }

    $base_path = $submodule ? MODULE_PATH . 'Common/' : app_path('Helpers/');

    foreach ($files as $vo) {
        $helper = $base_path . $vo . '.php';
        if (file_exists($helper)) {
            require_once($helper);
        }
    }
}

/**
 * 加载语言包
 * @param array $files
 * @param string $module
 */
function load_lang($files = [], $module = '')
{
    static $_LANG = [];

    if (!is_array($files)) {
        $files = [$files];
    }

    $base_path = resource_path('lang/' . $GLOBALS['_CFG']['lang'] . '/' . ($module ? $module . '/' : ''));

    foreach ($files as $vo) {
        $helper = $base_path . $vo . '.php';
        $lang = null;
        if (file_exists($helper)) {
            $lang = require($helper);
            if (!is_null($lang)) {
                $_LANG = array_merge($_LANG, $lang);
            }
        }
    }

    $GLOBALS['_LANG'] = $_LANG;
}
