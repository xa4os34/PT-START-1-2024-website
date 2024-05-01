<div class="osition-absolute top-0 start-50 translate-middle-x card mt-3 p-2" style="max-width: 26rem;">
    <form method="POST" class="mx-2">
        <p class="fs-2 text-center mb-3">Login</p>
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input required type="text" class="form-control" name="username" 
                   id="inputUsername" value="<?php echo htmlspecialchars($_POST["username"])?>" 
                   aria-describedby="usernameHelp">
        </div>
        <div class="mb-3">
            <label for="inputPassword1" class="form-label">Password</label>
            <input required type="password" class="form-control mb-2" name="password" 
                   id="inputPassword1" aria-describedby="passwordHelp">
        </div>
        <div class="md-3">
            <?php if ($loginFailed) { ?>
            <p class="text-danger">Wrong username or password.</p>
            <?php }?>
        </div>
        <div class="mb-3 text-center">
            <input hidden type="text" name="csrf" value="<?php echo GetCsrfToken();?>">
            <input required type="submit" class="btn btn-primary" value="Login" name="submit">
        </div>
        <div class="md-3 text-center">
            <p>If you have no account yet, you can <a href="/registration">registrate</a> new.</p>
        </div>
    </form>
</div>
