<?php 

include "_utils.php";
include "_database.php";

session_start();

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: /");
    exit;
}

$loginFailed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    
    CsrfTokenRequired();

    $username = ParamRequired("username");
    $password = ParamRequired("password");

    // And here. also nothing!!!
    $result = GetUserByUsername($username);

    if ($result == null || !password_verify($password, $result->PasswordHash)) {
        Unauthorized();
        $loginFailed = true;
        goto renderPage;
    }

    $_SESSION['is_auth'] = true;
    $_SESSION['user_id'] = $result->Id;
    $_SESSION['username'] = $result->Username;
    $_SESSION['email'] = $result->Email;

    header("Location: /");
    exit;
}

renderPage:

$title = "Login";
$mainBody = 'views/_login.php';
include '_layout.php';
?>
