<?php

session_start();
$_SESSION = array();
session_unset();
session_destroy();

header("Location: /registration");

$title = "Login";
$mainBody = 'views/_login.php';
include '_layout.php';
?>
