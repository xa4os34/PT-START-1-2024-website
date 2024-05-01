<?php
function BadRequest($message) {
        echo $message;
        header('HTTP/1.1 400 Bad Request', true, 400);
}

function Unauthorized() {
    header("HTTP/1.1 401 Unauthorized");
}

function ParamRequired($parameter_name) {
    $parameter = $_POST[$parameter_name];
    if (!isset($parameter) || strlen($parameter) <= 0) {
        BadRequest('Parameter \'' . $parameter_name . '\' is required');
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

function GetCsrfToken() : string {
    $token = md5(uniqid(mt_rand(), true));
    $_SESSION["csrf_token"] = $token;
    return $token;
}

function CsrfTokenRequired() {
    $token = ParamRequired("csrf");
    if ($_SESSION["csrf_token"] != $token) {
        BadRequest("Invalid csrf token");
        exit;
    }
    $_SESSION["csrf_token"] = null;
}

function IsImage($fileInfo) : bool {
    $allowedTypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png'];

    $fileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $fileInfo['tmp_name']);
    
    return in_array($fileType, $allowedTypes);
}


?>
