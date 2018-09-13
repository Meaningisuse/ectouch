<?php

return [
    'DEFAULT_MODULE'         => 'Web', // 默认模块
    'URL_MODEL'              => 3, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    'VAR_PATHINFO'           => 'r', // 兼容模式PATHINFO获取变量例如 ?r=/module/action/id/1 后面的参数取决于URL_PATHINFO_DEPR

    /* 数据库设置 */
    'DB_TYPE'                => 'mysql', // 数据库类型
    'DB_HOST'                => '127.0.0.1', // 服务器地址
    'DB_NAME'                => 'ectouch', // 数据库名
    'DB_USER'                => 'root', // 用户名
    'DB_PWD'                 => '', // 密码
    'DB_PORT'                => '3306', // 端口
    'DB_PREFIX'              => 'ecs_', // 数据库表前缀
    'DB_CHARSET'             => 'utf8', // 数据库编码默认采用utf8

    'TMPL_EXCEPTION_FILE'    => THINK_PATH . 'Tpl/think_exception.tpl', // 异常页面的模板文件
    'TAGLIB_BEGIN'           => '{', // 标签库标签开始标记
    'TAGLIB_END'             => '}', // 标签库标签结束标记


];