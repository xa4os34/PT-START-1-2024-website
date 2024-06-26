<div class="card" style="width: 18rem; height: 26rem">
    <img src="/files/title-images/<?php echo rawurlencode($post->TitleImage); ?>" 
         style="object-fit: cover; height: 10.1rem" class="card-img-top" 
         alt="<?php echo htmlspecialchars($post->Title); ?>">
    <div class="card-body overflow-hidden line-clamp">
        <h5 class="card-title text-truncate">
            <?php echo htmlspecialchars($post->Title) ?>
        </h5>
        <?php echo htmlspecialchars(substr(str_replace('#', '', $post->Content), 0, 200)); ?>
    </div>
    <div class="ms-1 mb-1">
        <span>by <?php echo htmlspecialchars($post->Owner->Username);?></span>
    </div>
    <div class="card-footer">
        <div class="text-end">
           <a href="/posts?id=<?php echo $post->Id;?>" class="btn btn-primary">Read more</a>
        </div>
    </div>
</div>
