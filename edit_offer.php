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
        <form action='script/s_edit_offer.php' method='post'>
            <input placeholder='Titre' name='title' type='text' value='$title'><br>
            <textarea placeholder='Contenu' name='content' type='text'>$content</textarea><br>
            <button type='submit' name='oid' value='$oid'>Modifier</button>
            </form>
    ";
} else {
    echo "L'offre n'a pas été trouvée.";
}


include_once("footer.php");
?>