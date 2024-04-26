<?php
session_start();

if ($_SESSION['is_auth'] != true){
   header("Location: /registration");
   exit;
}

$title = "ten reasons why i hate js";
$mainBody = 'views/_index.php';
include '_layout.php';
exit
?>
