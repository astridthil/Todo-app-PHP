<?php

session_start();

$_SESSION['logged_in'] = false;
$_SESSION['user'] = null;

header('Location: /sites/inlamning-todo');