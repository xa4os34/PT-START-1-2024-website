<?php 

session_start();

include '_database.php';
include '_utils.php';

AuthorizationRequired();

$validationErrors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    CsrfTokenRequired();

    $titleImage = null;
    $title = strip_tags(ParamRequired("title"));
    $content = strip_tags(ParamRequired("content"));

    if (strlen($content) > 2000)
        array_push($validationErrors, "Content must be less then 2000 characters long.");

    if (strlen($title) > 100)
        array_push($validationErrors, "Title must be less then 100 characters long.");

    if (isset($_FILES["titleImage"]) && intval($_FILES["titleImage"]["size"]) > 0) {
        $fileInfo = $_FILES["titleImage"];
        if ($fileInfo["size"] > 1048576) {
            array_push($validationErrors, "Size of Title Image must be less then 1MiB.");
            goto renderPage;
        }

        $titleImage = basename($fileInfo["name"]);
        move_uploaded_file($fileInfo["tmp_name"], getcwd() . "/files/title-images/" . $titleImage);
    }

    if (count($validationErrors) > 0)
        goto renderPage;   

    $userId = $_SESSION["user_id"];
    $postId = CreatePost($title, $content, $titleImage, $userId);

    if ($postId == null)
        die();

    header("HTTP/1.1 302 Found");
    header("Location: /posts?id={$postId}");
    exit;
}

renderPage:
$title = 'New post';
$mainBody = 'views/_new-post.php';
include '_layout.php';
?>
