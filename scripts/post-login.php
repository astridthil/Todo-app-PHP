<?php

session_start();

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/User.php';

$success = false;

if(isset($_POST['username']) && isset($_POST['password']) ) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();

    $user = $db->get_user_by_username($username);

    if($user) {
        $success = $user->test_password($password);

        if($success) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $user;
        }

    }

} else {
    echo 'invalid input';
    var_dump($_POST);
    die();
}

if($success) {
    header('Location: /sites/inlamning-todo');
} else {
    echo 'Login failed';
}