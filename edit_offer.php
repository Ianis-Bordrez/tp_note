<?php
include_once("header.php");


isNotConnectedRedirect();

$oid = $_POST['oid'];

if(!isset($oid)) {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:pid');
$req->execute(array('pid' => $oid));
$offer_info = $req->fetch();

if ($offer_info) {
    $title = $offer_info['title'];
    $content = $offer_info['content'];

    echo "
<div class='row center'>
    <div class='col s4 offset-s4'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Modifier votre offre</span>
            <div class='card-action'>
                <form action='script/s_edit_offer.php' method='post'>
                    <div class='input-field'>
                        <input id='title' name='title' type='text' class='validate' value='$title'>
                        <label for='title'>Titre de l'offre</label>
                    </div>
                    <div class='input-field'>
                        <textarea id='contenu' name='content' class='materialize-textarea'>$content</textarea>
                        <label for='contenu'>Contenu de l'offre</label>
                    </div>
                    <button class='btn waves-effect waves-light' type='submit' name='oid' value='$oid'>Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
    ";
} else {
    echo "L'offre n'a pas été trouvée.";
}


include_once("footer.php");
?>