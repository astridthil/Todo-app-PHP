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
    <title>SINGLE TODO</title>
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

<div class='single-todo'>
    <h1 class='single-todo-title'><?= $todo->title ?></h1>
    <p class='single-todo-date'>
        <?= $todo->date ?>
    </p>

    <form action="../scripts/delete-todo.php" method='post'>
        <a class='btn btn-delete' href="edit-todo.php?id=<?= $todo->id ?>">Edit todo</a>
        <input type="hidden" name='id' value='<?= $todo->id ?>'>
        <input type="submit" class='btn btn-delete' value='Delete' >
    </form>

</div>
</body>
</html>