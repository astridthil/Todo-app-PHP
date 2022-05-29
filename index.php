<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Todo.php';
require_once __DIR__ . "/google-config.php";

$google_login_btn = '<a href="' . $google_client->createAuthUrl() . '">Login with Google</a>';

$db = new Database();

$todos = $db->get_all_todos();

$logged_in = (isset($_SESSION['user']) && isset($_SESSION['logged_in']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOS</title>
    <link rel="stylesheet" href="/sites/inlamning-todo/assets/style.css">
</head>
<body>

<?php if(!$logged_in) : ?>
<nav class='loggedout-nav'> 
    <a  class='btn register-btn' href="/sites/inlamning-todo/pages/register-user.php">register </a>
    <a class='btn login-btn' href="/sites/inlamning-todo/pages/login.php">login</a>
</nav>

<div class='google-btn'>
<?= $google_login_btn ?>
</div>
<?php else: ?>
    <nav class='nav'>
        <p class='todo-logo'><b>Todo</b></p>
    <p>
        <b class='welcome'>Welcome </b>
        <?= $_SESSION['user']->username ?>
    </p>
        <form action="/sites/inlamning-todo/scripts/post-logout.php" method="post">
        <input class='btn logout-btn' type="submit" value="logout">
        </form>
    </nav class='nav'>

<div class='todo-form'>
<h1 class='add-todo-title'>Add todos</h1>

<form action="scripts/create-todo.php" method="post">
    <input class='input-todo' type="text" name="todo-title" placeholder="Todo title">
    <br>
    <input class='input-todo' type="date" name="todo-date">
    <br>
    <input class='btn add-btn' type="submit" value="Add">
</form>

<div class='all-todos'>
<h3 class='all-todos-title'><?= $_SESSION['user']->username ?>´s todos</h3>

<?php
$todos = $db->get_all_todos();
foreach($todos as $todo) : 
?>

<?php if($todo->user_id == $_SESSION['user']->id) : ?>
<div>
<p class='todo' >
    <a href="pages/single-todo.php?id=<?= $todo->id ?>">
      <?= $todo ?>
    <form class='delete-edit' action="scripts/delete-todo.php" method='post'>
        <input type="hidden" name='id' value='<?= $todo->id ?>'>
        <label class="container">
            <input type="checkbox">
            <span class="checkmark"></span>
        </label>
        <input type="submit" class='btn btn-delete btn-delete-todos' value='Delete' >
    </form>
</a>
</p>
</div>
<?php endif; ?>
<?php endforeach; ?>

<?php endif; ?>
</div>
</div>
</body>
</html>