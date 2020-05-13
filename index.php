<?php

require_once('script/main_function.php');

if (isConnected()){
    echo "<h1> Salut ".$_SESSION['username']."</h1>";
}
?>

<a href="signup.php">Inscription</a>
<a href="logout.php">Déconnexion</a>
<a href="login.php">Connexion</a>
<a href="profile.php">Profile</a>