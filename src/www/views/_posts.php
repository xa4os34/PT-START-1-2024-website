<div class="container d-flex justify-content-center flex-wrap gap-3">
    <?php 
    foreach($posts as $post) {
        $post = $post;
        include 'views/_postCard.php';
    }
    ?>
</div>
