<?php
require_once __DIR__ . '/../classes/Database.php';

session_start();

$db = new Database();

$todo = $db->get_single_todo($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT TODO</title>
    <link rel="stylesheet" href="/sites/inlamning-todo/assets/style.css">
</head>
<body>
<nav class='nav'>
<a href="/sites/inlamning-todo/index.php" class='todo-logo'><b>Todo</b></a>
    <p>
            <b class='welcome'>Logged in as </b>
            <?= $_SESSION['user']->username ?>
        </p>
        <form action="/sites/inlamning-todo/scripts/post-logout.php" method="post">
    <input class='btn logout-btn' type="submit" value="logout">
    </form>
    </nav>
    <div class='edit-todo'>
    <h1 class='single-todo-title'>Edit</h1>

    <p>
        <a href="single-todo.php?id= <?= $todo->id ?>">Go back to <?= $todo->title ?></a>
    </p>

    <form action="../scripts/post-edit-todo.php" method='post'>
        <input class='input-todo' type="text" name="todo-title" placeholder="todo title" value='<?= $todo->title ?>'><br>
        <input class='input-todo' type="date" name="todo-date" placeholder="todo date" value='<?= $todo->date ?>'><br>
        <input type="hidden" name="id" value="<?= $todo->id ?>">
        <input class='btn add-btn' type="submit" value="Update">
    </form>
    </div>
</body>
</html>