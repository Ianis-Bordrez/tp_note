<?php
include_once("header.php");

isNotConnectedRedirect();

if ($_SESSION['status'] != "ENTREPRISE") {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$bdd = mysqlConnect();
$req = $bdd->prepare('SELECT company_id FROM company WHERE boss_id = :id');
$req->execute(array('id' => $_SESSION['account_id']));
$company = $req->fetch();

if ($company) {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

echo "
<div class='row center'>
    <div class='col s6 offset-s3'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Votre entreprise</span>
            <div class='card-action'>
                <form action='script/s_company.php' method='post'>
                    <div class='input-field'>
                        <input id='name' name='name' type='text' class='validate'>
                        <label for='name'>Nom de l'entreprise</label>
                    </div class='input-field'>
                    <div class='input-field'>
                        <textarea id='description' name='description' class='materialize-textarea'></textarea>
                        <label for='description'>Description de l'entreprise</label>
                    </div class='input-field'>
                    <div class='row'>
                        <div class='input-field col s3'>
                            <input id='nbrPersonnals' name='nbrPersonnals' type='text' class='validate'>
                            <label for='nbrPersonnals'>Nombre de personnels</label>
                        </div class='input-field'>
                        <div class='input-field col s9'>
                            <input id='activityArea' name='activityArea' type='text' class='validate'>
                            <label for='activityArea'>Domaine d'activité</label>
                        </div class='input-field'>
                    <div class='row'>
                    <button class='btn waves-effect waves-light' type='submit'>Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
";

include_once("footer.php");
?>