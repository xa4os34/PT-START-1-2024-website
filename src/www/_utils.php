<?php
function badRequest($message) {
        echo $message;
        header('HTTP/1.1 400 Bad Request', true, 400);
}

function Unauthorized() {
    header("HTTP/1.1 401 Unauthorized");
}

function paramRequired($parameter_name) {
    $parameter = $_POST[$parameter_name];
    if (!isset($parameter) || strlen($parameter) <= 0) {
        badRequest('Parameter \'' . $parameter_name . '\' is required');
        exit;
    }
    return $parameter;
}

function IsAuthorized() : bool {
    return isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true;
}

function AuthorizationRequired() {
    if (!IsAuthorized()) {
        Unauthorized();
        header("Location: /login");
        exit;
    }
}


?>
