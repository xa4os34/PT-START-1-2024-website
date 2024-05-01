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

    if (count($validationErrors) > 0)
        goto renderPage;   

    if (isset($_FILES["titleImage"]) && $_FILES["titleImage"]["size"] > 0) {  
        $fileInfo = $_FILES["titleImage"];
        
        if (@$fileInfo["error"] !== UPLOAD_ERR_OK) 
            array_push($validationErrors, "Something went wrong so we couldn't upload the file.");

        if (@$fileInfo["size"] > 1048576) 
            array_push($validationErrors, "Size of Title Image must be less then 1MiB.");

        if (!IsImage($fileInfo)) 
            array_push($validationErrors, "File must be png, jpg or gif.");

        if (count($validationErrors) > 0) {
            goto renderPage;   
        }


        $fileExtension = pathinfo($fileInfo["name"], PATHINFO_EXTENSION);
        $titleImage = uniqid() . ".{$fileExtension}";
        if (!move_uploaded_file($fileInfo["tmp_name"], getcwd() . "/files/title-images/" .  $titleImage)) {
            array_push($validationErrors, "Something went wrong so we couldn't upload the file.");
            goto renderPage;
        }
    }


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
