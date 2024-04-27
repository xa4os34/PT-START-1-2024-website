<?php

session_start();

include '_utils.php';

AuthorizationRequired();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   

    CsrfTokenRequired();

    $_SESSION = array();
    session_unset();
    session_destroy();

    header("HTTP/1.1 302 Found");
    header("Location: /registration");
    exit;
}

$title = "Login";
$mainBody = 'views/_logout.php';
include '_layout.php';
?>
