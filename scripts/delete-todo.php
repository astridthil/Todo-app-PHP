<?php
require_once __DIR__ . '/../classes/Database.php';

if(isset($_POST['id'])) {

    $success = false;

    $db = new Database();

    $todo_id = $_POST['id'];

    $success = $db->delete_todo($todo_id);
}

if($success) {
    header("Location: /sites/inlamning-todo");
} else {
    echo "Error deleting todo";
}