<div class="osition-absolute top-0 start-50 translate-middle-x card mt-5 p-2" style="width: 26rem;">
    <p class="fs-2 text-center mb-3">Logging out</p>
    <form method="POST" class="form text-center">
        <p class="fs-4">Are you sure?</p>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="/">Go Back</a>
            </div>
            <div class="col">
                <input hidden type="text" name="csrf" value="<?php echo GetCsrfToken();?>">
                <input class="btn btn-danger" type="submit" name="submit" value="Logout">
            </div>
        </div>
    </form
</div>
