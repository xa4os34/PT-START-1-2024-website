<div class="osition-absolute top-0 start-50 translate-middle-x card mt-3 p-2" style="max-width: 26rem;">
    <form method="POST" class="mx-2">
        <p class="fs-2 text-center mb-3">Registration</p>
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input required type="text" class="form-control" name="username" id="inputUsername" value="<?php echo htmlspecialchars($_POST["username"])?>" aria-describedby="usernameHelp">
            <div id="usernameHelp" class="form-text">The username may only contain letters, numbers, dashes and underscores and must be 3-30 characters long.</div>
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="email" id="inputEmail" value="<?php echo htmlspecialchars($_POST["email"])?>" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="inputPassword1" class="form-label">Password</label>
            <input required type="password" class="form-control mb-2" name="password" id="inputPassword1" aria-describedby="passwordHelp">
            <input required type="password" class="form-control" name="passwordSecond" id="inputPassword2" aria-describedby="passwordHelp">
            <div id="passwordHelp" class="form-text">You able write anything you want here.</div>
        </div>
        <div class="md-3">
        <?php foreach ($validationErrors as $error) { ?>
            <p class="text-danger"><?php echo $error; ?></p>
        <?php }?>
        </div>
        <div class="mb-3 text-center">
            <input hidden type="text" name="csrf" value="<?php echo GetCsrfToken();?>">
            <input required type="submit" class="btn btn-primary" value="Registrate" name="submit">
        </div>
        <div class="md-3 text-center">
            <p>If you already have account, you can <a href="/login">login here</a>.</p>
        </div>
    </form>
</div>
