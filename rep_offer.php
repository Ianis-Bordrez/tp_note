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

$req = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:pid');
$req->execute(array('pid' => $pid));
$offer_info = $req->fetch();

if (!$offer_info) {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$title = $offer_info['title'];
$content = $offer_info['content'];
$date = $offer_info['offer_date'];
echo "
    <div> 
        <h2>$title</h2>
        <p>$content</p>
        <p>$date</p>
    </div>
    <hr>
    ";

echo "
    <form action='script/s_rep_offer.php' method='post'>
        <textarea placeholder='Votre réponse' name='content' type='text'></textarea><br>
        <input name='submit' type='submit' value='Répondre'>
    </form>    
    ";

include_once("footer.php");
?>