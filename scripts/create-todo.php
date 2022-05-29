<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Todo.php';

session_start();

$success = false;

if(isset($_POST["todo-title"]) && isset($_POST["todo-date"]) && isset($_SESSION['user'])){

    $user = $_SESSION['user'];
    $db = new Database();

    $todo = new Todo($_POST["todo-title"], $_POST["todo-date"], $user->id);

    $success = $db->save_todo($todo);
}

if($success) {
    header("Location: /sites/inlamning-todo");
} else {
    echo "Error creating todo";
}