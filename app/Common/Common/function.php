<?php

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
 * @throws \App\Kernel\Exception
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
 * @return \App\Kernel\Controller|false
 */
function action($name, $layer = '', $level = 0)
{
    return A($name, $layer, $level);
}

/**
 * 远程调用
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
 * 行为函数
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
 * @return \App\Kernel\Model
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
 * @return \App\Kernel\Model
 */
function dao($name = '', $tablePrefix = '', $connection = '')
{
    return M($name, $tablePrefix, $connection);
}
