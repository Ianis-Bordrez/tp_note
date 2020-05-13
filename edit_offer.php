<?php
include_once("header.php");


isNotConnectedRedirect();

$pid = $_GET['pid'];

if(!isset($pid)) {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:pid');
$req1->execute(array(
    'pid' => $pid
));
$resultat = $req1->fetch();

$title = $resultat['title'];
$content = $resultat['content'];

echo "
    <form action='script/s_edit_offer.php?pid=$pid' method='post'>
        <input placeholder='Titre' name='title' type='text' value='$title'><br>
        <textarea placeholder='Contenu' name='content' type='text'>$content</textarea><br>
        <input name='submit' type='submit' value='Modifier'>
    </form>
";

include_once("footer.php");
?>