<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM company WHERE boss_id=:pid');
$req->execute(array('pid' => $_SESSION['account_id']));
$resultat = $req->fetch();

if (!$resultat){
    header('Location: index.php');
    exit();
}

$company_id = $resultat['company_id'];
$name = $resultat['name'];
$description = $resultat['description'];
$member = $resultat['member'];
$activity_area = $resultat['activity_area'];

echo "
    <form action='script/s_edit_company.php?pid=$company_id' method='post'>
        <input placeholder='Nom' name='name' type='text' value='$name'><br>
        <textarea placeholder='Courte descritption' name='description' type='text'>$description</textarea><br>
        <input placeholder='Nombre de personnels' name='nbrPersonnals' type='text' value='$member'><br>
        <input placeholder='\"Domaine d'activit'e\"' name='activityArea' type='text' value='$activity_area'><br>
        <input name='submit' type='submit' value='Modifier'>
    </form>
";

include_once("footer.php");
?>