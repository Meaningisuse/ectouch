<?php

return [
    'default_module' => 'web',

    'url_router_on' => true,
    'url_map_rules' => require base_path('routes/web.php'),
    'url_module_map' => [ADMIN_PATH => 'console'],

    /* 数据库设置 */
    'db_type' => 'mysql', // 数据库类型
    'db_host' => '127.0.0.1', // 服务器地址
    'db_name' => 'ectouch', // 数据库名
    'db_user' => 'root', // 用户名
    'db_pwd' => '', // 密码
    'db_port' => '3306', // 端口
    'db_prefix' => 'ecs_', // 数据库表前缀
    'db_charset' => 'utf8', // 数据库编码默认采用utf8

    /* 模板设置 */
    'taglib_begin' => '{',
    'taglib_end' => '}',
];