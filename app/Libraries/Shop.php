<?php

namespace App\Libraries;

/**
 * 基础类
 */
class Shop
{
    public $db_name = '';
    public $prefix = 'ecs_';

    /**
     * Shop constructor.
     */
    public function __construct()
    {
        $this->db_name = config('DB_NAME');
        $this->prefix = config('DB_PREFIX');
    }

    /**
     * 将指定的表名加上前缀后返回
     *
     * @access  public
     * @param   string $str 表名
     *
     * @return  string
     */
    public function table($str)
    {
        return '`' . $this->db_name . '`.`' . $this->prefix . $str . '`';
    }

    /**
     * ECTouch 密码编译方法;
     *
     * @access  public
     * @param   string $pass 需要编译的原始密码
     *
     * @return  string
     */
    public function compile_password($pass)
    {
        return md5($pass);
    }

    /**
     * 取得当前的域名
     *
     * @access  public
     *
     * @return  string      当前的域名
     */
    public function get_domain()
    {
        return url('/');
    }

    /**
     * 获得 ECTouch 当前环境的 URL 地址
     * @return mixed|string
     */
    public function url()
    {
        $root = request()->rootDomain();

        if (substr($root, -1) != '/') {
            $root .= '/';
        }

        return $root;
    }

    /**
     * 获得 ECTouch 当前环境的 HTTP 协议方式
     * @return string
     */
    public function http()
    {
        return request()->getScheme() . '://';
    }

    /**
     * 获得数据目录的路径
     *
     * @param int $sid
     *
     * @return string 路径
     */
    public function data_dir($sid = 0)
    {
        if (empty($sid)) {
            $s = 'data';
        } else {
            $s = 'user_files/';
            $s .= ceil($sid / 3000) . '/';
            $s .= $sid % 3000;
        }
        return $s;
    }

    /**
     * 获得图片的目录路径
     *
     * @param int $sid
     *
     * @return string 路径
     */
    public function image_dir($sid = 0)
    {
        if (empty($sid)) {
            $s = 'images';
        } else {
            $s = 'user_files/';
            $s .= ceil($sid / 3000) . '/';
            $s .= ($sid % 3000) . '/';
            $s .= 'images';
        }
        return $s;
    }
}
