<?php

session_start();

include '_utils.php';
include '_database.php';

AuthorizationRequired();

$posts = GetUserPosts($_SESSION["user_id"]);
$title = "Profile";
$mainBody = "views/_profile.php";
include '_layout.php';
?>
