<?php

require_once('script/main_function.php');

if (isConnected()) {
    header('Location: index.php');
    exit;
}
?>

<form action="script/s_login.php" method="post">
<input type="text" name="userName" placeholder="Nom d'utilisateur" />
<input type="password" name="password" placeholder="Mot de passe" />
<button type="submit">Envoyer</button>
</form>

