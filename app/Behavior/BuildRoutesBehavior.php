<?php

namespace App\Behavior;

class BuildRoutesBehavior
{
    public function run()
    {
        if (APP_DEBUG) {
            $this->build(['web', 'console']);
        }
    }

    /**
     * @param array $modules
     */
    protected function build($modules = [])
    {
        foreach ($modules as $module) {
            $web = glob(app_path(parse_name($module, 1) . '/Controller/*'));

            $route = [];
            foreach ($web as $item) {
                $item = basename($item, 'Controller.php');
                if ($item == 'Init') continue;
                $route[parse_name($item)] = parse_name($module, 1) . '/' . $item . '/index';
            }

            file_put_contents(base_path('routes/' . $module . '.php'), "<?php\n\nreturn " . var_export($route, true) . ';');
        }
    }
}