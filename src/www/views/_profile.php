<div class="container">
    <p class="fs-1 mb-4">Profile</p>
    <p class="fs-3 mb-4">Username: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p class="fs-3 mb-4">Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p class="fs-3 mb-4">Your posts:</p>
    <hr>
    <div class="d-flex justify-content-center flex-wrap gap-3">
        <?php 
        foreach($posts as $post) {
            $post = $post;
            include 'views/_postCard.php';
        }
        ?>
        <div class="btn card text-center position-relative bg-dark bg-opacity-50 border border-3" style="width: 18rem; height: 26rem">
            <a class="btn fs-5 btn-secondary position-absolute top-50 start-50 translate-middle" href="/new-post">
                Write a new post!
            </a>
        </div>
    </div>
<div>
