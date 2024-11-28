<?php
    require BASE_PATH . '/core/Model.php';

    class UserModel extends Model {
        function __construct($table = 'todo_users') {
            $this->table = $table;
        }
        /*
        public function check_auth(): bool {
            $conn   = $this->connectDB();
            $result = false;

            if ($conn) {
                $sql      = "SELECT * FROM ".$this->table." WHERE `id` = $id";
                $user = $conn->query($sql);
                if ($user) {
                    $result = $user->fetch(PDO::FETCH_ASSOC);
                }
            }

            return $result;
        }
*/
        public function login($username = null, $password = null) {
            $conn   = $this->connectDB();
            $user = null;

            if ($conn) {
                $check_user      = "SELECT * FROM".$this->table." WHERE `username` = :".$username." ";
                $stmt = $conn->query($check_user);
                //var_dump($stmt);
                if ($stmt===FALSE) {
                    header('Location: /');
                    die;
                }
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            if (password_verify($password, $user['password'])) {
                if (password_needs_rehash($password, PASSWORD_DEFAULT)) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    if ($conn) {
                        $sql      = "UPDATE ".$this->table." SET `password` = :".$newHash." WHERE `username` = :".$username." ";
                        $user = $conn->query($sql);
                    }
                }

                $_SESSION['user_id'] = $user['id'];
                header('Location: /');
                die;
            }
        }


        /*
        public function check_auth(): bool {
            return isset($_SESSION['user_id']);
        }

        if (check_auth()) {
            $stmt = pdo()->prepare("SELECT * FROM `todo_users` WHERE `id` = :id");
            $stmt->execute(['id' => $_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        */
    }


/*
    $user = null;

    if (check_auth()) {
        $stmt = pdo()->prepare("SELECT * FROM `todo_users` WHERE `id` = :id");
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    <?php if ($user) { ?>
    <?php } ?>


    function flash(?string $message = null) {
        if ($message) {
            $_SESSION['flash'] = $message;
        } else {
            if (!empty($_SESSION['flash'])) { ?>
            <div class="alert alert-danger mb-3">
                <?=$_SESSION['flash']?>
            </div>
            <?php }
            unset($_SESSION['flash']);
        }
    }

    function check_auth(): bool {
        return isset($_SESSION['user_id']);
    }
    */