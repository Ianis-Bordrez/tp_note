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
<div class='row center'>
    <div class='col s6 offset-s3'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Votre entreprise</span>
            <div class='card-action'>
                <form action='script/s_edit_company.php' method='post'>
                    <div class='input-field'>
                        <input id='name' name='name' type='text' class='validate' value='$name'>
                        <label for='name'>Nom de l'entreprise</label>
                    </div class='input-field'>
                    <div class='input-field'>
                        <textarea id='description' name='description' class='materialize-textarea'>$description</textarea>
                        <label for='description'>Description de l'entreprise</label>
                    </div class='input-field'>
                    <div class='row'>
                        <div class='input-field col s3'>
                            <input id='nbrPersonnals' name='nbrPersonnals' type='text' class='validate' value='$member'>
                            <label for='nbrPersonnals'>Nombre de personnels</label>
                        </div class='input-field'>
                        <div class='input-field col s9'>
                            <input id='activityArea' name='activityArea' type='text' class='validate'  value='$activity_area'>
                            <label for='activityArea'>Domaine d'activité</label>
                        </div class='input-field'>
                    <div class='row'>
                    <button class='btn waves-effect waves-light' type='submit' name='cid' value='$cid'>Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
";

include_once("footer.php");
?>