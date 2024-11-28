<?php
    class Router {
        public static function route() {
            require BASE_PATH . '/app/routes.php';

            // Получаем путь без GET-параметров
            $request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            /*print_r($request);
            print_r(routes);
            foreach (routes as $pattern => $target) {
                if (preg_match(self::convertPatternToRegex($pattern), $request, $matches)) {
                    echo "совпадение найдено: $pattern";
                }
            }*/

            // Перебираем все маршруты
            foreach (routes as $pattern => $target) {
                $regex = self::convertPatternToRegex($pattern);
                $request = '/' . ltrim($request, '/'); // Добавляем слэш, если отсутствует
                /*var_dump($request);
                var_dump($regex);*/
                if (preg_match($regex, $request, $matches)) {
                    array_shift($matches); // Убираем полное совпадение из $matches
                    $controller = $target[0];
                    $method = $target[1];
                    /*var_dump($controller);
                    var_dump($method);*/
                    // Проверяем наличие файла контроллера
                    if (file_exists(BASE_PATH . '/app/controllers/' . $controller . '.php')) {
                        require BASE_PATH . '/app/controllers/' . $controller . '.php';
                        $class = new $controller();

                        // Проверяем наличие метода и вызываем его с параметрами
                        if (method_exists($controller, $method)) {
                            //$class->$method(...$matches);
                            $class->$method(...array_values($matches));
                            exit;
                        }
                    }
                }
            }

            // Если ничего не найдено, возвращаем 404
            http_response_code(404);
            include BASE_PATH . '/app/views/not_found.php';
        }

        // Метод для конвертации шаблона в регулярное выражение
        private static function convertPatternToRegex($pattern) {
            $escaped = preg_quote($pattern, '#'); // Экранирует специальные символы
            $regex = preg_replace('#\\\{([^/]+)\\\}#', '(?P<\1>[^/]+)', $escaped);
            return "#^" . $regex . "$#";
        }
    }

    /*class Router {
        public static function route() {
            require BASE_PATH . '/app/routes.php';

            $request = trim($_SERVER['REQUEST_URI']);

            if (array_key_exists($request, routes)) {
                $controller = routes[$request][0];
                $method = routes[$request][1];
                if (file_exists(BASE_PATH . '/app/controllers/' . $controller . '.php')) {
                    require BASE_PATH . '/app/controllers/' . $controller . '.php';
                    $class = new $controller();
                    if (method_exists($controller, $method)) {
                        $class->$method();
                        exit;
                    }
                }
            }

            http_response_code(404);
            include BASE_PATH . '/app/views/not_found.php';
        }
    }*/