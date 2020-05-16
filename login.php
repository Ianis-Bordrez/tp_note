<?php
include_once("header.php");

isConnectedRedirect();

echo "
    <div class='row center'>
        <div class='col s4 offset-s4'>
            <div class='card blue-grey darken-1'>
                <span class='card-title'>Veuillez vous connecter</span>
                <div class='card-action'>
                    <form action='script/s_login.php' method='post'>
                        <div class='input-field'>
                            <input id='userName' name='userName' type='text' class='validate'>
                            <label for='userName'>Nom d'utilisateur</label>
                        </div>
                        <div class='input-field'>
                            <input id='password' name='password' type='password' class='validate'>
                            <label for='password'>Mot de passe</label>
                        </div>
                        <button class='btn waves-effect waves-light' type='submit'>Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
";

include_once("footer.php");
?>