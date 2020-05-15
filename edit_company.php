<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

if (isset($_POST['cid'])){
    $pid = $_POST['cid'];
} else {
    $pid = $_SESSION['account_id'];
}

$req = $bdd->prepare('SELECT * FROM company WHERE boss_id=:pid');
$req->execute(array('pid' => $pid));
$resultat = $req->fetch();

if (!$resultat){
    header('Location: index.php');
    exit();
}

$cid = $resultat['company_id'];
$name = $resultat['name'];
$description = $resultat['description'];
$member = $resultat['member'];
$activity_area = $resultat['activity_area'];

echo "
    <form action='script/s_edit_company.php' method='post'>
        <input placeholder='Nom' name='name' type='text' value='$name'><br>
        <textarea placeholder='Courte descritption' name='description' type='text'>$description</textarea><br>
        <input placeholder='Nombre de personnels' name='nbrPersonnals' type='text' value='$member'><br>
        <input placeholder='\"Domaine d'activit'e\"' name='activityArea' type='text' value='$activity_area'><br>
        <button type='submit' name='cid' value='$cid'>Modifier</button>
    </form>
";

include_once("footer.php");
?>