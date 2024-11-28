<?php
    require BASE_PATH . '/core/Model.php';

    class TodoModel extends Model {
        function __construct($table = 'todo_tasks') {
            $this->table = $table;
        }

        public function getCountTodoTasks() {
            $conn     = $this->connectDB();
            $totalTasks   = null;

            if ($conn) {
                $total_tasks = "SELECT COUNT(*) AS total FROM ".$this->table."";
                $stmt = $conn->query($total_tasks);
                if ($stmt) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $totalTasks = intval($row['total']);
                    //var_dump($totalTasks);
                }
                return $totalTasks;
            }
        }
        public function getAll($start = null, $tasks_per_page = null) {
            /*var_dump($start);
            var_dump($tasks_per_page);*/

            $conn     = $this->connectDB();
            $result   = null;
            //$sort = @$_GET['sort'];

            /*$queries = array();
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $sort = $queries['sort'];

            $sort_list = array (
                'sort_user_name_asc'   => '`user_name`',
                'sort_user_name_desc'  => '`user_name` DESC',
                'sort_user_email_asc'  => '`user_email`',
                'sort_user_email_desc' => '`user_email` DESC',
                'sort_completed_asc'   => '`completed`',
                'sort_completed_desc'  => '`completed` DESC',  
            );
            if (array_key_exists($sort, $sort_list)) {
                $sort_sql = $sort_list[$sort];
            } else {
                $sort_sql = reset($sort_list);
            }*/

            if ($conn) {
                //$sql      = "SELECT * FROM ".$this->table." ORDER BY ".$sort_sql." ASC LIMIT ".TASKS_PER_PAGE."";
                //$total_tasks = "SELECT COUNT(id) FROM ".$this->table."";
                $sql      = "SELECT * FROM ".$this->table." ORDER BY id ASC LIMIT ".$start.",".$tasks_per_page."";
                $resource = $conn->query($sql);
                if ($resource) {
                    $result = $resource->fetchAll(PDO::FETCH_ASSOC);
                }
            }

            return $result;
            /*return ['tasks' => $result,
                    'total_tasks' => $totalTasks];*/
        }

        public function insert($data = array()) {
            $conn   = $this->connectDB();
            $result = false;

            if ($conn) {
                $sql = "INSERT INTO {$this->table} (user_name, user_email, task_description)
                        VALUES (?,?,?)";

                $result = $conn->prepare($sql)->execute([
                $data['user_name'], $data['user_email'], $data['task_description']
                ]);
            }
            return $result;
        }

        public function update($data) {
            $result = false;
            $conn   = $this->connectDB();

            if ($conn) {
                $sql = "UPDATE {$this->table}
                        SET user_name=?, user_email=?, task_description=?
                        WHERE id=?";
                $result = $conn->prepare($sql)->execute([
                    $data['user_name'], $data['user_email'], $data['task_description'], $data['id']
                ]);
            }

            return $result;
        }
    }