<div class="container">
    <form class="form" enctype="multipart/form-data" method="POST">
        <p class="text-center fs-1">New post</p>
        <div class="mb-4" style="max-width: 30rem;">
            <label for="inputTitle" class="form-label fs-4">Title</label>
            <input required type="text" class="form-control text-bold" name="title"
                id="inputTitle" value="<?php echo htmlspecialchars($_POST["title"])?>">
        </div>
        <div class="mb-4" style="max-width: 30rem;">
            <label for="inputTitleImage" class="form-label fs-4">Title image</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <input class="form-control" type="file" name="titleImage" id="inputTitleImage">
        </div>
        <div class="mb-4">
            <label for="inputContent" class="form-label fs-4">Content</label>
            <textarea requird style="min-height: 30rem;" class="form-control" type="text"
                      name="content" maxlength="2000" id="inputContent">
                <?php echo htmlspecialchars($_POST["content"])?>
            </textarea>
        </div>
        <div class="md-3">
        <?php foreach ($validationErrors as $error) { ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php }?>
        </div>
        <div class="mb-4">
            <input hidden type="text" name="csrf" value="<?php echo GetCsrfToken();?>">
            <input required type="submit" class="btn btn-primary" value="Create" name="submit">
        </div>
    </form>
<div>
