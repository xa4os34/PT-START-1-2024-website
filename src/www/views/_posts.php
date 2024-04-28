<div class="container d-flex flex-wrap gap-3">
    <?php 
    foreach($posts as $post) {
        $post = $post;
        include 'views/_postCard.php';
    }
    ?>
</div>
