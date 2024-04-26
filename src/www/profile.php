<?php

include '_utils.php';

session_start();

AuthorizationRequired();

$title = "Profile";
$mainBody = "views/_profile.php";
include '_layout.php';
?>
