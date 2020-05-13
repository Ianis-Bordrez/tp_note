<?php
include_once("header.php");



isConnectedRedirect();

echo "
    <form action='script/s_signup.php' method='post'><br>
        <input type='text' name='userName' placeholder='Nom d'utilisateur'><br>
        <input type='password' name='password' placeholder='Mot de passe'><br>
        <input type='text' name='name' placeholder='Nom'><br>
        <input type='text' name='firstName' placeholder='Prénom'><br>
        <input type='text' name='email' placeholder='Email'><br>
        <input type='text' name='phone' placeholder='Numéro tél.' maxlength='10'><br>
        <select name='status'>
            <option value='CANDIDAT'>Un candidat</option>
            <option value='ENTREPRISE'>Une entreprise</option>
            <option value='ADMIN'>Un admin</option>
        </select><br>
        <button type='submit'>Envoyer</button>
    </form>
";

include_once("footer.php");
?>