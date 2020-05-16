<?php
include_once("header.php");

isNotConnectedRedirect();

echo "
    <div class='row center'>
        <div class='col s4 offset-s4'>
            <div class='card blue-grey darken-1'>
                <span class='card-title'>Poster une offre</span>
                <div class='card-action'>
                    <form action='script/s_new_offer.php' method='post'>
                        <div class='input-field'>
                            <input id='title' name='title' type='text' class='validate'>
                            <label for='title'>Title de l'offre</label>
                        </div>
                        <div class='input-field'>
                            <textarea id='contenu' name='content' class='materialize-textarea'></textarea>
                            <label for='contenu'>Contenu de l'offre</label>
                        </div>
                        <button class='btn waves-effect waves-light' type='submit'>Poster</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
";

include_once("footer.php");
?>