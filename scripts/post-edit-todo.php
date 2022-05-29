<?php
require_once __DIR__ . '/../classes/Database.php';

session_start();

$success = false;

if(isset($_POST['todo-title']) && isset($_POST['todo-date']) && isset($_SESSION['user']) && isset($_POST['id'])) {

    $user = $_SESSION['user'];
    $db = new Database();

    $todo = new Todo($_POST['todo-title'], $_POST['todo-date'], $user->id, $_POST['id']);
    
    $success = $db->update_todo($todo);  
} else {
    echo 'invalid input';
}

if($success) {
    header("Location: /sites/inlamning-todo/pages/single-todo.php?id=" . $_POST['id']);
} else {
    echo "Error editing todo";
}