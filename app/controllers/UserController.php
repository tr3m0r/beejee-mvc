<?php
    require BASE_PATH . '/core/Controller.php';
    require BASE_PATH . '/app/models/UserModel.php';

    class UserController extends Controller {
        private $model;
        public $user = null;

        function __construct() {
            $this->model = new UserModel();
        }

        public function login() {
            $user = null;

            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
                $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
                $user = $this->model->login($username, $password);
            }

            $this->loadView('login.tpl.php', [
                'user' => $user,
            ]);
        }

        public function logout() {
            $_SESSION['user_id'] = null;
            header('Location: /');
        }

    }