<?php
header('HTTP/1.1 404 Not found', true, 404);
$title = "Error 404";
$mainBody = 'views/_error404.php';
include '_layout.php';
?>
