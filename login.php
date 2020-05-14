<?php
include_once("header.php");

isConnectedRedirect();

echo "
    <form action='script/s_login.php' method='post'>
        <input type='text' name='userName' placeholder=\"Nom d'utilisateur\">
        <input type='password' name='password' placeholder='Mot de passe'>
        <button type='submit'>Envoyer</button>
    </form>
";

include_once("footer.php");
?>