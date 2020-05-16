<?php
include_once("header.php");

isConnectedRedirect();

echo "
    <div class='row center'>
    <div class='col s6 offset-s3'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Veuillez vous inscrire</span>
            <div class='card-action'>
                <form action='script/s_signup.php' method='post'>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input id='userName' name='userName' type='text' class='validate'>
                        <label for='userName'>Nom d'utilisateur</label>
                    </div>
                    <div class='input-field col s6'>
                        <input id='password' name='password' type='password' class='validate'>
                        <label for='password'>Mot de passe</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input id='name' name='name' type='text' class='validate'>
                        <label for='name'>Nom</label>
                    </div>
                    <div class='input-field col s6'>
                        <input id='firstName' name='firstName' type='text' class='validate'>
                        <label for='firstName'>Prénom</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input id='email' name='email' type='text' class='validate'>
                        <label for='email'>Adresse Email</label>
                    </div>
                    <div class='input-field col s6'>
                        <input id='phone' name='phone' type='tel' class='validate' maxlength='10'>
                        <label for='phone'>Numéro de téléphone</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='col s11'>
                        Quel type de compte voulez-vous :
                        <div class='input-field inline'>
                            <p>
                                <label>
                                    <input name='status' value='CANDIDAT' type='radio' checked />
                                    <span>Candidat</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name='status' value='ENTREPRISE' type='radio' />
                                    <span>Entreprise</span>
                                </label>
                            </p>
                        </div>
                    </div>                   
                </div>
                    <button class='btn waves-effect waves-light' type='submit'>S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    </div>
";

include_once("footer.php");
?>