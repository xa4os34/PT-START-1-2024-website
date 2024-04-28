<?php
session_start();

include '_utils.php';

AuthorizationRequired();

$title = "ten reasons why i hate js";
$mainBody = 'views/_index.php';
include '_layout.php';
exit
?>
