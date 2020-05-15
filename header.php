<?php
require_once('script/main_function.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP NOTÉ</title>
    <meta name="desc" content="Site d'offres d'emploi.">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    
    <div id="container">
        <header id="flex_header">
            <img src="img/logo.svg">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="all_offer.php">Toutes les offres</a></li>
                    <?php
                    if (isConnected()){
                        if ($_SESSION['status'] == 'CANDIDAT') {
                            echo "<li><a href='profile.php'>Mon profil</a></li>";
                            echo "<li><a href='response.php'>Mes réponses</a></li>";
                        } elseif ($_SESSION['status'] == 'ENTREPRISE') {
                            echo "<li><a href='profile.php'>Mon profil</a></li>";
                            echo "<li><a href='my_offer.php'>Mes offres</a></li>";
                            echo "<li><a href='new_offer.php'>Poster une offre</a></li>";
                        } elseif ($_SESSION['status'] == 'ADMIN') {
                            echo "<li><a href='all_profile.php'>Tous les profils</a></li>";
                        }
                    }
                    ?>
                </ul>
            </nav>
            <ul>
                <?php
                if (isConnected()){
                    echo "<li><a href='script/s_logout.php'>Déconnexion</a></li>";
                } else {
                    echo "
                    <li><a href='login.php'>Connexion</a></li>
                    <li><a href='signup.php'>Inscription</a></li>
                    ";
                }
                ?>
            </ul>
        </header>
        <hr>
        <section id="content">