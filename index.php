<?php

// Setting session id with header to avoid error

session_start();

if (!isset($_COOKIE['PHPSESSID'])) {
    header("Location: index.php");
} else {

// Checking if liste-films.json is existing, then execute the code

if (is_file('liste-films.json')) {
    $contents = json_decode(file_get_contents('liste-films.json'), true);
}

// Read liste-films.json

$contents = json_decode(file_get_contents('liste-films.json'), true);

// Creating a random number to display a random film

$random = mt_rand(0, count($contents) -1);
$film = $contents[$random];

?>

<!-- HTML -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>

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

        .film__header {
            display: flex;
            flex-direction: row;
        }

        .film__cover {
            margin-top: -120px;
            width: 30%;
            margin-right: 10%;
        }

        .film__content {
            width: 50%;
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

        .fav-btn {
            background-color: #013778;
            color: white;
            border: none;
            padding: 10px 30px;
            cursor: pointer;
        }

        .fav-btn:hover {
            background-color: #4771a6;
        }

        /* End Favoris */

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
    <div class="film__header">
        <?= "<img class='film__cover' src='".$film['cover_url']."'alt=''>"?>
        <div class="film__content">
            <?= "<h1 class='film__title'>".$film['name']."<small> (".$film['production_year'].")</small></h1>"?>
            <form method="post" action="favoris.php"><input type="hidden" name="fav" <?= "value='".$random."'"?>> <input type="submit" class="fav-btn" value="Ajouter aux favoris" name="submit"></form>
            <?= "<p>".$film['synopsis']."</p>"?>
            <?= "<a href='".$film['trailer_url']."' target='_blank'>Voir le trailer</a>"?>
        </div>
    </div>
    <div class="film__distrib">
        <h2>Distribution</h2>
        <ul>

        <!-- Displaying the random film -->

            <?php 

            $characters = $film['actors']; 
            $a = 0;

            // For each characters, displaying the name of the character and the name of the actor

            foreach ($characters as $character) {
                $character = $characters[$a];
                echo "<li><strong>".$character['character'].": </strong>".$character['name']."</li>";
                $a++;
            }
}            

            ?>

        </ul>
    </div>
</div>

<!-- End Film Section -->

</body>
</html>