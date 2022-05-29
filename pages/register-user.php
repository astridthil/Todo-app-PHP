<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER USER</title>
    <link rel="stylesheet" href="/sites/inlamning-todo/assets/style.css">
</head>
<body>
<div class='edit-todo'>
<h1 class='single-todo-title'>Register user</h1>
<p>
    <a href="login.php">Login</a>
</p>

<form action="/sites/inlamning-todo/scripts/post-register-user.php" method="post">
<input class='input-todo' type="text" name='username' placeholder='username'>
<br>
<input class='input-todo' type="password" name='password' placeholder='password'>
<br>
<input class='btn add-btn' type="submit" value="Register">
</form>
</div>
</body>
</html>