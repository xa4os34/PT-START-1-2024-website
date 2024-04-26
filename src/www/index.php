<?php
session_start();

if ($_SESSION['is_auth'] != true){
   header("Location: /registration");
   exit;
}
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

    <main>
        <div class="container">
            <p class="fs-2 text-bold">
                Ten reasons why I hate JS.
            </p>
            <div class="mb-4 text-center">
                <img class="spoiler blured img-fluid" src="https://i.imgflip.com/8nz7bt.jpg"/>
            </div>
            <p class="fs-3 mb-0">
                1. JS can't sort arrays.
            </p>
            <hr>
            <p class="fs-4">
                JS has method called 'sort', but this method works wrong. As an exaple if you create an array with
                positive and negetive numbers [1, 3, 2, -1, -3, -2] and then call the method you get this: [-1, -2, -3,
                1, 2, 3].
                You can test it right now, just put this <code class="theme-atom-one-dark language-javascript">[1, 3, 2,
                    -1, -3, -2].sort()</code> to your browser
                console (F12 or RBM &#x21d2; Inspect &#x21d2 Console).

            </p>
            <p class="fs-4">
                I think that's enough for now.
            </p>
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