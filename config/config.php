<?php

return array_merge([
    'default_module'         => 'Web', // 默认模块
    'default_theme'          => 'default',

    'url_model'              => 3, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    'url_router_on'          => true,
    'url_map_rules'          => require base_path('routes/web.php'),
    'url_module_map'         => [ADMIN_PATH => 'console'],
    'var_pathinfo'           => 'r', // 兼容模式PATHINFO获取变量例如 ?r=/module/action/id/1 后面的参数取决于URL_PATHINFO_DEPR

    'tmpl_exception_file'    => resource_path('views/errors/exception.html'), // 异常页面的模板文件
    'taglib_begin'           => '{', // 标签库标签开始标记
    'taglib_end'             => '}', // 标签库标签结束标记

], require __DIR__ . '/database.php');
