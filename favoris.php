<?php

// Setting session id with header to avoid error

session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
    header("Location: favoris.php");
} else {

// Making an empty board

$list_favs = [];

// Creating user folder

if (!is_dir('user')) {
    mkdir('user');
}

// If favoris.json is existing, then execute the code

if (is_file('user/'.$_COOKIE['PHPSESSID'].'favoris.json')) {
    $list_favs = json_decode(file_get_contents('user/'.$_COOKIE['PHPSESSID'].'favoris.json'), true);
}

// If the form is not empty, then reading liste-films.json, writing in favoris.json and reading favoris.json

if (!empty($_POST['fav']) && !empty($_POST['submit'])) {

    $contents = json_decode(file_get_contents('liste-films.json'), true);
    $fav = $_POST['fav'];
    $title = $contents[$fav];
    $film = ['name' => $title['name'], 'cover_url' => $title['cover_url']];
    $list_favs[] = $film;
    file_put_contents('user/'.$_COOKIE['PHPSESSID'].'favoris.json',json_encode($list_favs));
    $list_favs = json_decode(file_get_contents('user/'.$_COOKIE['PHPSESSID'].'favoris.json'), true);
}

?>

<!-- HTML -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes Favoris</title>

    <!-- Style -->

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            padding-top: 20px;
            margin: 0;
            background-color: #013778;
            font-family: Ubuntu, sans-serif;
        }

        /* Film */

        .film {
            width: calc(100vw - 40px);
            padding: 20px 100px;
            max-width: 1200px;
            margin: 120px auto 20px;
            background-color: white;
        }

        a {
            font-weight: bold;
            color: #013778;
            text-decoration: none;
        }

        a:hover {
            color: #4771a6;
        }

        /* End Film */
        /* Header */

        header ul {
            margin: 0;
            display: flex;
            flex-direction: row;
            background-color: white;
            justify-content: center;
        }

        header a {
            display: block;
            padding: 15px;
        }

        header li {
            list-style-type: none;
        }

        header a:hover {
            background-color: aliceblue;
        }

        /* End Header */
        /* Favoris */

       .fav-list {
           display: flex;
           flex-wrap: wrap;
       }

       .fav-card img{
           max-width: 100%;
       }

       .fav-card {
           width: 25%;
           padding: 20px;
       }

        /* End Favoris */
        /* Fab Bar */

        .fab-bar {
            margin: 20px;
            padding: 10px 30px;
            background-color: white;
        }

        /* End Fab Bar */

    </style>

    <!-- End Style -->

</head>
<body>
<header>

    <!-- Nav Bar -->

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="favoris.php">Favoris</a></li>
            <li><a href="search.php">Recherche</a></li>
        </ul>
    </nav>

    <!-- End Nav Bar -->

</header>

<?php

// If user fav a new movie, then showing a message confirming that the movie has been add to his favorites

if (isset($_POST['fav']) && isset($_POST['submit'])) {

    // Fab Bar

    echo "<div class='fab-bar'>";
    echo "<h2>".$title['name']." ajouté aux favoris</h2>";
    header('Refresh:2; favoris.php');
}

?>

</div>

<!-- End Fab Bar -->
<!-- Film Section -->

<div class="film">
    <h1>Favoris</h1>
    <div class="fav-list">


<?php 

// If the user has already been on the site, his favorites movies are shown

    foreach ($list_favs as $film) {
        echo    "<div class='fav-card'>
                    <img src='".$film['cover_url']."' alt=''>
                    <h2>".$film['name']."</h2>
                </div>";
    }
}

?>

    </div>
</div>

<!-- End Film Section -->

</body>
</html>
