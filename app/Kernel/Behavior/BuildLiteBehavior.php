<?php

namespace App\Kernel\Behavior;

class BuildLiteBehavior
{
    public function run(&$params)
    {
        if (!defined('BUILD_LITE_FILE') || BUILD_LITE_FILE == false) {
            return;
        }

        $litefile = C('RUNTIME_LITE_FILE', null, RUNTIME_PATH . 'lite.php');
        if (is_file($litefile)) {
            return;
        }

        $defs    = get_defined_constants(true);
        $content = 'namespace {$GLOBALS[\'_beginTime\'] = microtime(TRUE);';
        if (MEMORY_LIMIT_ON) {
            $content .= '$GLOBALS[\'_startUseMems\'] = memory_get_usage();';
        }

        // 生成数组定义
        unset($defs['user']['BUILD_LITE_FILE']);
        $content .= $this->buildArrayDefine($defs['user']) . '}';

        // 读取编译列表文件
        $filelist = is_file(CONF_PATH . 'lite.php') ?
        include CONF_PATH . 'lite.php' :
        array(
            SUPPORT_PATH . 'functions.php',
            COMMON_PATH . 'Common/function.php',
            KERNEL_PATH . 'Kernel' . EXT,
            KERNEL_PATH . 'Hook' . EXT,
            KERNEL_PATH . 'App' . EXT,
            KERNEL_PATH . 'Dispatcher' . EXT,
            KERNEL_PATH . 'Log' . EXT,
            KERNEL_PATH . 'Log/Driver/File' . EXT,
            KERNEL_PATH . 'Route' . EXT,
            KERNEL_PATH . 'Controller' . EXT,
            KERNEL_PATH . 'View' . EXT,
            KERNEL_PATH . 'Storage' . EXT,
            KERNEL_PATH . 'Storage/Driver/File' . EXT,
            KERNEL_PATH . 'Exception' . EXT,
            KERNEL_PATH . 'Behavior/ParseTemplateBehavior' . EXT,
            KERNEL_PATH . 'Behavior/ContentReplaceBehavior' . EXT,
        );

        // 编译文件
        foreach ($filelist as $file) {
            if (is_file($file)) {
                $content .= compile($file);
            }
        }

        // 处理Think类的start方法
        $content = preg_replace('/\$runtimefile = RUNTIME_PATH(.+?)(if\(APP_STATUS)/', '\2', $content, 1);
        $content .= "\nnamespace { App\Kernel\Kernel::addMap(" . var_export(\App\Kernel\Kernel::getMap(), true) . ");";
        $content .= "\nL(" . var_export(L(), true) . ");\nC(" . var_export(C(), true) . ');App\Kernel\Hook::import(' . var_export(\App\Kernel\Hook::get(), true) . ');App\Kernel\Kernel::start();}';

        // 生成运行Lite文件
        file_put_contents($litefile, strip_whitespace('<?php ' . $content));
    }

    // 根据数组生成常量定义
    private function buildArrayDefine($array)
    {
        $content = "\n";
        foreach ($array as $key => $val) {
            $key = strtoupper($key);
            $content .= 'defined(\'' . $key . '\') or ';
            if (is_int($val) || is_float($val)) {
                $content .= "define('" . $key . "'," . $val . ');';
            } elseif (is_bool($val)) {
                $val = ($val) ? 'true' : 'false';
                $content .= "define('" . $key . "'," . $val . ');';
            } elseif (is_string($val)) {
                $content .= "define('" . $key . "','" . addslashes($val) . "');";
            }
            $content .= "\n";
        }
        return $content;
    }
}
