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
</head>
<body>
    <div id="container">
        <header id="flex_header">
            <img src="img/logo.svg">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="offer.php">Toutes les offres</a></li>
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