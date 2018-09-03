<?php

return [
    // 配置文件
    'config' => [
        KERNEL_PATH . 'Config/convention.php', // 系统惯例配置
        CONF_PATH . 'config' . CONF_EXT, // 应用公共配置
    ],

    // 别名定义
    'alias'  => [
        'App\Kernel\Log'               => KERNEL_PATH . 'Log' . EXT,
        'App\Kernel\Log\Driver\File'   => KERNEL_PATH . 'Log/Driver/File' . EXT,
        'App\Kernel\Exception'         => KERNEL_PATH . 'Exception' . EXT,
        'App\Kernel\Model'             => KERNEL_PATH . 'Model' . EXT,
        'App\Kernel\Db'                => KERNEL_PATH . 'Db' . EXT,
        'App\Kernel\Template'          => KERNEL_PATH . 'Template' . EXT,
        'App\Kernel\Cache'             => KERNEL_PATH . 'Cache' . EXT,
        'App\Kernel\Cache\Driver\File' => KERNEL_PATH . 'Cache/Driver/File' . EXT,
        'App\Kernel\Storage'           => KERNEL_PATH . 'Storage' . EXT,
    ],

    // 函数和类文件
    'core'   => [
        SUPPORT_PATH . 'functions.php',
        COMMON_PATH . 'Common/function.php',
        KERNEL_PATH . 'Hook' . EXT,
        KERNEL_PATH . 'App' . EXT,
        KERNEL_PATH . 'Dispatcher' . EXT,
        KERNEL_PATH . 'Route' . EXT,
        KERNEL_PATH . 'Controller' . EXT,
        KERNEL_PATH . 'View' . EXT,
        KERNEL_PATH . 'Behavior/BuildLiteBehavior' . EXT,
        KERNEL_PATH . 'Behavior/ParseTemplateBehavior' . EXT,
        KERNEL_PATH . 'Behavior/ContentReplaceBehavior' . EXT,
    ],
    // 行为扩展定义
    'tags'   => [
        'app_init'        => [
            'App\Kernel\Behavior\BuildLiteBehavior', // 生成运行Lite文件
        ],
        'app_begin'       => [
            'App\Kernel\Behavior\ReadHtmlCacheBehavior', // 读取静态缓存
        ],
        'app_end'         => [
            'App\Kernel\Behavior\ShowPageTraceBehavior', // 页面Trace显示
        ],
        'view_parse'      => [
            'App\Kernel\Behavior\ParseTemplateBehavior', // 模板解析 支持PHP、内置模板引擎和第三方模板引擎
        ],
        'template_filter' => [
            'App\Kernel\Behavior\ContentReplaceBehavior', // 模板输出替换
        ],
        'view_filter'     => [
            'App\Kernel\Behavior\WriteHtmlCacheBehavior', // 写入静态缓存
        ],
    ],
];
