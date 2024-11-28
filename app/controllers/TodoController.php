<?php
    require BASE_PATH . '/core/Controller.php';
    require BASE_PATH . '/app/models/TodoModel.php';
    //require BASE_PATH . '/app/helpers/SortHelper.php';
    //use app\helpers\SortHelper;

    class TodoController extends Controller {
        private $model;
        public $_page = null;

        function __construct() {
            $this->model = new TodoModel();
        }

        public function index($page = null) {
            //текущая страница (по умолчанию 1)
            if ($page == null) {
                $this->_page = 1;
            } elseif ($page != null) {
                $this->_page = $page;
            }

            //var_dump($this->_page);

            //получаем лимит записей на страницу из конфига
            $tasks_per_page = TASKS_PER_PAGE;

            //общее количество записей
            $total_tasks = $this->model->getCountTodoTasks();

            //общее количество страниц
            $total_pages = ceil($total_tasks / $tasks_per_page);

            $current_page = $this->_page;

            //убеждаемся, что страница в допустимом диапазоне
            $current_page = max(1, min($current_page, $total_pages));
            $start = ($current_page -1) * $tasks_per_page;

            $tasks = $this->model->getAll($start, $tasks_per_page);

            $this->loadView('home.tpl.php', [
                'tasks' => $tasks,
                'total_pages' => $total_pages,
                'current_page' => $current_page,
                //'page' => $_GET['page'],
                /*'sort' => $sortLink,*/
            ]);
        }

        public function add() {
            $response = array('success' => false);
            $data = array(
                'name' => filter_var(trim($_POST['user_name']), FILTER_SANITIZE_STRING),
                'email' => filter_var(trim($_POST['user_email']), FILTER_SANITIZE_STRING),
                'task' => filter_var(trim($_POST['task_description']), FILTER_SANITIZE_EMAIL),
                'completed' => ((isset($_POST['completed']) == 'on') ? 1 : 0),
            );
            if (!empty($data['name']) && !empty($data['email']) && !empty($data['task']) && !empty($data['completed'])) {
                $response['success'] = $this->model->insert($data);
            }
    
            echo json_encode($response);
        }

        public function login() {
            if(!$this->model->check_auth()) {
                return false;
            }
        }
    }