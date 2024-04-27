<?php

session_start();

include '_utils.php';

AuthorizationRequired();

$title = "Profile";
$mainBody = "views/_profile.php";
include '_layout.php';
?>
