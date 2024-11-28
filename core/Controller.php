<?php
    class Controller {
        function __construct() {
        }

        public function check_auth(): bool {
            return !!($_SESSION['user_id'] ?? false);
        }

        public function loadView($name = '', $arg = array()) {
            $path = BASE_PATH . "/app/views/{$name}";
            $data = array();

            foreach ($arg as $key => $value) {
                $data[$key] = $value;
            }
            //var_dump($data);

            ob_start();
            include($path);
            $content = ob_get_contents();
            ob_end_clean();
            //print_r($data, $content);
            //die();
            echo $content;
        }
    }