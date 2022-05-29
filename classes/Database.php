<?php
require_once __DIR__ . "/Todo.php";
require_once __DIR__ . "/User.php";

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $db= "db-todo";

    private $conn;

    public function __construct()  {
    $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

    if(!$this->conn) {
        die("connection failed");
    }
    }

    public function save_todo(Todo $todo) {
        $query = 'INSERT INTO todos (title, `date`, userId) VALUES (?, ?, ?)';

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('ssi', $todo->title, $todo->date, $todo->user_id);

        $success = $stmt->execute();

        return $success;
    }

    public function get_all_todos() {
        $query = 'SELECT * FROM todos';

        $result = mysqli_query($this->conn, $query);

        $db_todos = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $todos = [];

        foreach($db_todos as $db_todo) {
            $db_todo_id = (int)$db_todo['id'];
            $db_todo_title = $db_todo['title'];
            $db_todo_date = $db_todo['date'];
            $db_todo_user_id = $db_todo['userId'];

            $todo = new Todo($db_todo_title, $db_todo_date, $db_todo_user_id ,$db_todo_id);

            $todos[] = $todo;
        }
        return $todos;
    }
    public function get_single_todo($id) {
        $query = 'SELECT * FROM todos WHERE id = ?';

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('i', $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_todo = mysqli_fetch_assoc($result);

        $db_todo_id = $db_todo['id'];
        $db_todo_title = $db_todo['title'];
        $db_todo_date = $db_todo['date'];
        $db_todo_user_id = $db_todo['userId'];

        $todo = new Todo($db_todo_title, $db_todo_date, $db_todo_user_id, $db_todo_id);

        return $todo;
    }

    public function update_todo(Todo $todo) {
        $query = 'UPDATE todos SET title = ?, date = ? WHERE id = ?';

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('ssi', $todo->title, $todo->date, $todo->id);

        return $stmt->execute();
    }

    public function delete_todo($id) {
        $query = 'DELETE FROM todos WHERE id = ?';

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    public function save_user(User $user) {
        $query = 'INSERT INTO users (`username`, `password-hash`) VALUES (?, ?)';
 
        $stmt = mysqli_prepare($this->conn, $query);
 
        $username = $user->username;
        $password_hash = $user->get_password_hash();
 
        $stmt->bind_param('ss', $username, $password_hash);
 
        $success = $stmt->execute();
 
        return $success;
 
     }
     public function get_user_by_username($username) {
         $query = 'SELECT * FROM users WHERE username = ?';
 
         $stmt = mysqli_prepare($this->conn, $query);
 
         $stmt->bind_param('s', $username);
 
         $success = $stmt->execute();
 
         $result = $stmt->get_result();
 
         $db_user = mysqli_fetch_assoc($result);
 
         $user = null;
 
         if($db_user) {
             $user = new User($username, $db_user['id']);
             $user->set_password_hash($db_user['password-hash']);
         }
         return $user;
     }

     public function get_google_user_id(User $user) {
         $db_user = $this->get_user_by_username($user->username);

         if($db_user == null) {
            $query = 'INSERT INTO users (username) VALUES (?)';
 
            $stmt = mysqli_prepare($this->conn, $query);
     
            $username = $user->username;
     
            $stmt->bind_param('s', $username);
     
            $success = $stmt->execute();

            if($success) {
                $user->id = $stmt->insert_id;
            } else {
                die('error saving google user');
            }
         } else {
             $user = $db_user;
         }

         return $user->id;
     }
}