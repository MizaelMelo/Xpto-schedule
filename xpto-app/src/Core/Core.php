<?php
namespace App\Core;

use Symfony\Component\Yaml\Yaml;

class Core
{
    public function run()
    {
        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);

        $params = array();
        if (!empty($url)) {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }

        } else {
            $currentController = 'agendaController';
            $currentAction = 'index';
        }

        $controllerClassName = '\\App\\Controllers\\' . $currentController;

        if (!class_exists($controllerClassName)) { (new \App\Controllers\errorController())->index();
            return;
        }

        $controllerClass = new $controllerClassName();
        $controllerClass->{$currentAction}($params);
	}
}
