<?php

return [
    'default_module'         => 'Web', // 默认模块
    'default_theme'          => 'default',

    'url_model'              => 3, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    'url_router_on'          => true,
    'url_map_rules'          => require base_path('routes/web.php'),
    'url_module_map'         => [ADMIN_PATH => 'console'],
    'var_pathinfo'           => 'r', // 兼容模式PATHINFO获取变量例如 ?r=/module/action/id/1 后面的参数取决于URL_PATHINFO_DEPR

    /* 数据库设置 */
    'db_type'                => 'mysql', // 数据库类型
    'db_host'                => '127.0.0.1', // 服务器地址
    'db_name'                => 'ectouch', // 数据库名
    'db_user'                => 'root', // 用户名
    'db_pwd'                 => '', // 密码
    'db_port'                => '3306', // 端口
    'db_prefix'              => 'ecs_', // 数据库表前缀
    'db_charset'             => 'utf8', // 数据库编码默认采用utf8

    'tmpl_exception_file'    => resource_path('views/errors/exception.html'), // 异常页面的模板文件
    'taglib_begin'           => '{', // 标签库标签开始标记
    'taglib_end'             => '}', // 标签库标签结束标记

];