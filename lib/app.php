<?php

class App
{

    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url);
        $url = explode('/', $url);
        session_start();
        $page = $_SESSION['login'] ? 'main' : 'login';

        if (empty($url[0])) {
            $path = 'controller/' . $page . '.php';
            require_once $path;
            $controller = new $page;
            $controller->loadModel('login');
            $controller->render();
            return false;
        }
        $url[0] = $_SESSION['login'] ? $url[0] : 'login';
        $path = 'controller/' . $url[0] . '.php';

        if (file_exists($path)) {
            if (isset($_SESSION['user']) && $url[0] != "login" && $url[0] != "main" && $url[0] != "shared" && $url[0] != "jobs") {
                $flagPermission = true;
                foreach ($_SESSION['user']['PRIVILEGIOS'] as $pathPermission) {
                    $route = str_replace('/', '', $pathPermission['path']);
                    if ($route == $url[0]) {
                        $flagPermission = false;
                        break;
                    }
                }

                if ($flagPermission) {
                    require_once 'controller/error.php';
                    $controller = new ErrorResource();
                    return false;
                }
            }

            require_once $path;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if (isset($url[1])) {
                if (isset($url[2])) {
                    $controller->{$url[1]}($url[2]);
                    if (isset($url[3]))
                        $controller->{$url[1]}($url[3], $url[2]);
                } else {
                    $controller->{$url[1]}();
                }
            } else {
                $controller->render();
            }
        } else {
            require_once 'controller/error.php';
            $controller = new ErrorResource();
        }
    }
}
