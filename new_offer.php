<?php
include_once("header.php");

isNotConnectedRedirect();

echo "
    <form action='script/s_new_offer.php' method='post'>
        <input placeholder='Titre' name='title' type='text'><br>
        <textarea placeholder='Contenu' name='content' type='text'></textarea><br>
        <input name='submit' type='submit' value='Poster'>
    </form>
";

include_once("footer.php");
?>