<?php 

include "database.php";

function badRequest($message) {
        echo $message;
        header('HTTP/1.1 400 Bad Request', true, 400);
        exit;
}

function paramRequired($parameter_name) {
    $parameter = $_POST[$parameter_name];
    if (!isset($parameter) || strlen($parameter) <= 0)
        badRequest('Parameter \'' . $parameter_name . '\' is required');
}

session_start();

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: /");
    exit;
}

$loginFailed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    paramRequired("username");
    paramRequired("password");

    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // And here. also nothing!!!
    $result = GetUserByUsername($username);

    if ($result == null || password_verify($password, $result->PasswordHash)) {
        header("HTTP/1.1 401 Unauthorized");
        $loginFailed = true;
        goto renderPage;
    }

    $_SESSION['is_auth'] = true;
    $_SESSION['user_id'] = $result->Id;
    echo $result->Id;
    header("Location: /");
    exit;
}
renderPage:
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="files/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="static/site.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/a11y-dark.css">

    <title>ten reasons why i hate js</title>
</head>

<body data-bs-theme="dark">
    <header class="bg-dark text-white">
        <dev class="container">
            <a href="#" class="fs-1 text-bold text-white brand">ImShrimpCom</a>
        </dev>
    </header>

    <main class="position-relative">
        <div class="osition-absolute top-0 start-50 translate-middle-x card mt-5 p-2" style="width: 26rem;">
            <form method="POST">
                <p class="fs-2 text-center mb-3">Login</p>
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input required type="text" class="form-control" name="username" id="inputUsername" value="<?php echo $_POST["username"]?>" aria-describedby="usernameHelp">
                </div>
                <div class="mb-3">
                    <label for="inputPassword1" class="form-label">Password</label>
                    <input required type="password" class="form-control mb-2" name="password" id="inputPassword1" aria-describedby="passwordHelp">
                </div>
                <div class="md-3">
                <?php if ($loginFailed) { ?>
                    <p class="text-danger">Wrong username or password.</p>
                <?php }?>
                </div>
                <div class="mb-3 text-center">
                    <input required type="submit" class="btn btn-primary" value="login" name="submit">
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-dark">
        <div class="container">
            &copy; 2024 - ImShrimpCom
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <script src="static/site.js"></script>
    <script>
        hljs.configure({cssSelector: 'code'});;
        hljs.configure({useBR: true});
        hljs.highlightAll();
    </script>
</body>

</html>
