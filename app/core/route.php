<?php
    class Route {
        private static $routes = [
            '/' => PAGE . 'chat.php',
            'api/push-message/' => 'API/pushMessage',
            'api/get-messages/' => 'API/getMessages',
            'api/get-users/' => 'API/getUsers',
            'api/get-current-user/' => 'API/getCurrentUser',
            'api/test/' => 'API/test',
            'api/message/' => 'API/getLastMessage'
        ];
        public static function start() {
            $route = empty($_GET['route']) ? '/' : $_GET['route'];
            $route .= $route[mb_strlen($route)-1] == '/' ? '' : '/';
            if (array_key_exists($route, self::$routes)) {
                $path = self::$routes[$route];
                if (file_exists($path)) {
                    include($path);
                }
                else {
                    [$class, $method] = explode('/', $path);
                    if (class_exists($class)) {
                        if (method_exists($class, $method)) { $class::$method(); }
                        else { echo $class . '/' . $method; }
                    }
                    else { echo $class . '/' . $method; }
                }
            }
            else { echo $route; }
        }
    }
?>