<div class="container">
    <p class="fs-2 text-bold">
        <?php echo $post->Title; ?>
    </p>
    <div class="mb-4 text-center">
        <img class="img-fluid" src="/files/title-images/<?php echo $post->TitleImage; ?>"/>
    </div>
    <div class="fs-4">
    <?php
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $post->Content) as $line){

            if (str_starts_with($line, "# "))   
                echo "<p class=\"fs-1 mb-0\">" . substr($line, 2) . "</p><hr>";

            else if (str_starts_with($line, "## "))   
                echo "<p class=\"fs-2 mb-0\">" . substr($line, 3) . "</p><hr>";

            else if (str_starts_with($line, "### "))   
                echo "<p class=\"fs-3 mb-0\">" . substr($line, 4) . "</p><hr>";

            else if (trim($line) == '')
                echo "</p><p>";

            else echo $line;
        } 
     ?>
    </div>
</div>
