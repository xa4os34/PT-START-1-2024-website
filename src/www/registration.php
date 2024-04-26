<?php 

include "_database.php";
include "_utils.php";

session_start();

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: /");
    exit;
}

$validationErrors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $username = htmlspecialchars(paramRequired("username"));
    $email = htmlspecialchars(paramRequired("email"));
    $password = paramRequired("password");
    $passwordSecond = paramRequired("passwordSecond");

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
    $id = CreateUser($username, $email, $passwordHash);

    if ($id == null)
        die();

    $user = GetUserById($id);

    $_SESSION['is_auth'] = true;
    $_SESSION['user_id'] = $user->Id;
    $_SESSION['username'] = $user->Username;
    $_SESSION['email'] = $user->Email;

    header("Location: /");
    exit;
}
renderPage:
$title = "Registration";
$mainBody = "views/_registration.php";
include '_layout.php';
?>
