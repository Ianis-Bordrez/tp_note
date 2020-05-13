<?php

require_once('script/main_function.php');

if (isset($_SESSION['userName'])){

    ?> <h1> <?php echo "Salut ".$_SESSION['userName'] ?> </h1>

<?php
}
?>

<a href="signup.php">Inscription</a>
<a href="logout.php">Déconnexion</a>
<a href="login.php">Connexion</a>