<?php 

session_start();

include '_database.php';
include '_utils.php';

if (isset($_GET["id"])) {
    AuthorizationRequired();

    $id = $_GET["id"];

    // sql injection here
    $post = GetPostById($id);

    if ($post == null) {
        include 'error404.php';
        exit;
    }

    $title = $post->Title;
    $mainBody = 'views/_post.php';
    include '_layout.php';
    exit;
}

$posts = GetPosts();

if ($posts == null)
    $posts = array();

$title = 'Posts';
$mainBody = 'views/_posts.php';
include '_layout.php';
?>
