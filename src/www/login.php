<?php 

include "database.php";

function badRequest($message) {
        echo $message;
        header('HTTP/1.1 400 Bad Request', true, 400);
        exit;
}

function paramRequired($parameter_name) {
    $parameter = $_POST[$parameter_name];
    if (!isset($parameter) || strlen($parameter) <= 0)
        badRequest('Parameter \'' . $parameter_name . '\' is required');
}

session_start();

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: /");
    exit;
}

$loginFailed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    paramRequired("username");
    paramRequired("password");

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // And here. also nothing!!!
    $result = GetUserByUsername($username);

    if ($result == null || password_verify($password, $result->PasswordHash)) {
        header("HTTP/1.1 401 Unauthorized");
        $loginFailed = true;
        goto renderPage;
    }

    $_SESSION['is_auth'] = true;
    $_SESSION['user_id'] = $result->Id;
    echo $result->Id;
    header("Location: /");
    exit;
}

renderPage:

$title = "Login";
$mainBody = 'views/_login.php';
include '_layout.php';
?>
