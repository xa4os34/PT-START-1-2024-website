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

$validationErrors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    paramRequired("username");
    paramRequired("email");
    paramRequired("password");

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $passwordSecond = $_POST['passwordSecond'];

    if (strlen($username) > 30)
        array_push($validationErrors, "Username must be 31 characters long.");

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($validationErrors, "Email is invalid.");
    
    if ($password != $passwordSecond)
        array_push($validationErrors, "Passwords doesn't match to each other.");

    if (count($validationErrors) > 0)
        goto renderPage;

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // sql injection here. oh nyo! haha no nothing here.
    if (IsUsernameInUse($username)) 
        array_push($validationErrors, "Users with this name already exists.");

    // sql injection here. oh nyo! haha no nothing here.
    if (IsEmailInUse($email)) 
        array_push($validationErrors, "Users with this email already exists.");
    
    if (count($validationErrors) > 0)
        goto renderPage;

    // And here. also nothing!!!
    $result = CreateUser($username, $email, $passwordHash);

    if ($result == null)
        die();

    $_SESSION['is_auth'] = true;
    $_SESSION['user_id'] = $result;
    echo $result;
    header("Location: /");
    exit;
}
renderPage:
$title = "Registration";
$mainBody = "views/_registration.php";
include '_layout.php';
?>
