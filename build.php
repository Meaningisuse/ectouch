<?php

$thinkPath = __DIR__ . '/vendor/topthink/thinkphp/ThinkPHP/';

$rules = [
  'ThinkPHP.php' => [
      'Think\Think::start()' => 'class_alias(\'Think\Think\', \'ECTouch\')',
  ],
  'Common/functions.php' => [
      '$class = ($path' => "\$class = 'App\\\\';\n        \$class .= (\$path",
  ],
  'Library/Think/Build.class.php' => [
      'define(\'BUILD_DIR_SECURE\', true)' => 'define(\'BUILD_DIR_SECURE\', false)',
  ]
];

foreach($rules as $file => $rule) {
    $content = file_get_contents($thinkPath . $file);

    foreach ($rule as $key => $value) {
        $content = str_replace($key, $value, $content);
    }

    file_put_contents($thinkPath . $file, $content);
}
