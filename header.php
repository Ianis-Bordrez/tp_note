<?php
require_once('script/main_function.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>TP NOTÉ</title>
    <meta name="desc" content="Site d'offres d'emploi.">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
	.blink-bg{
		color: #fff;
		border-radius: 5px;
		animation: blinkingBackground 2s infinite;
	}
	@keyframes blinkingBackground{
		0%		{ background-color: #10c018;}
		25%		{ background-color: #1056c0;}
		50%		{ background-color: #ef0a1a;}
		75%		{ background-color: #254878;}
		100%	        { background-color: #04a1d5;}
	}
</style>  
</head>
<body>
        <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <div id="container">
        <header>
          <nav>
            <div class="nav-wrapper">
              <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="index.php">Accueil</a></li>
                <?php
                  if (isConnected()){
                    echo "<li><a href='profile.php'>Mon profil</a></li>";
                    if ($_SESSION['status'] == 'CANDIDAT'){
                      echo "<li><a href='my_answer.php'>Mes réponses</a></li>";
                    } elseif ($_SESSION['status'] == 'ENTREPRISE') {
                      echo "<li><a href='my_offer.php'>Mes offres</a></li>";
                      echo "<li><a href='new_offer.php'>Poster une offre</a></li>";
                    } elseif ($_SESSION['status'] == 'ADMIN') {
                      echo "<li><a href='all_profile.php'>Tous les profils</a></li>";
                    }
                  }
                ?>
              </ul>
              <a href="#" class="brand-logo center"><img src="img/logo.svg" width="65" height="65" alt="logo"></a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
              <?php
                if (isConnected()){
                  echo "<li><a href='script/s_logout.php'>Déconnexion</a></li>";
                } else {
                  echo "<li><a href='login.php'>Connexion</a></li>";
                  echo "<li><a href='signup.php'>Inscription</a></li>";
                }
              ?>
              </ul>
            </div>
          </nav>
        </header>
        <section id="content">
        <br>
