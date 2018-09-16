<?php

$route = require base_path('routes/console.php');

foreach ($route as $key => $item) {
    $route[ADMIN_PATH . '/' . $key] = $item;
    unset($route[$key]);
}

return [
    'url_map_rules' => $route,
];
