<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/User.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user = new User($username);
    
    $user->hash_password($password);
    
    $db = new Database();

    $success = $db->save_user($user);
} else {
    echo 'invalid input';
    var_dump($_POST);
    die();
}

if($success) {
    header('Location: /sites/inlamning-todo/pages/login.php');
} else {
    echo 'Error saving user';
    die();
}

