<?php

// Setting session id with header to avoid error

session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
    header("Location: search.php");
} else {

// Checking if liste-films.json is existing, then reading liste-films.json

if (is_file('liste-films.json')) {
    $contents = json_decode(file_get_contents('liste-films.json'), true);
}

?>

<!-- HTML -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rechercher un film</title>

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

        .fav-card img {
            max-width: 100%;
        }

        .fav-card {
            width: 25%;
            padding: 20px;
        }

        .fav-btn {
            background-color: #013778;
            color: white;
            border: none;
            padding: 10px 30px;
            cursor: pointer;
        }

        /* End Favoris */
        /* Search Form */

        .search-form > form:nth-child(1) > input:nth-child(1) {
            padding: 6px;
            border-radius: 0;
            border: 2px solid #013778;
            height: 40px;
        }

        /* End Search Form */

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

<!-- Film Section -->

<div class="film">
    <h1>Recherche</h1>
    <div class="search-form">
        <form method="get"><input type="text" name="search"><input type="submit" class="fav-btn"value="Rechercher" name="submit"></form>
    </div>
    <div class="fav-list">

    <?php

// Reading the code only if the inputs are not empty

if (!empty($_GET['search']) && !empty($_GET['submit'])) {

    // For each film, we lower all the title, then search if there are the input text on the film title

    foreach ($contents as $content) {
        $search = trim($_GET['search']);
        $str = strtolower($content['name']);

        // If there is the research on the film title, then displaying the cover and the title of the film

        if(strpos($str, $search) !== false){

        echo "<div class='fav-card'>
            <img src='".$content['cover_url']."' alt=''>
            <h2>".$content['name']."</h2>
        </div>";
        } 
    }
}
}

?>

    </div>
</div>

<!-- End Film Section -->

</body>
</html>