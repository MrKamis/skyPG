<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SkyPG - MMORPG</title>
    <base href="/">
    <link href="public/stylesheets/bootstrap.min.css" rel="stylesheet">
    <link href="public/stylesheets/main.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./">skyPG</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Nawigacja">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/profile">profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/smith">kowal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/adventure">przygoda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/job">praca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ranking">ranking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">wyloguj</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php
        require_once __DIR__ . '\app/helpers/router.php';
        Router::route($_GET);
    ?>

    <script src="public/javascripts/jquery.min.js"></script>
    <script src="public/javascripts/bootstrap.min.js"></script>
    <script src="public/javascripts/main.js"></script>
</body>
</html>