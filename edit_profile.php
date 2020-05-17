<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

if (isset($_POST['pid'])){
    $pid = $_POST['pid'];
} else {
    $pid = $_SESSION['account_id'];
}

$req = $bdd->prepare('SELECT * FROM account WHERE account_id=:pid');
$req->execute(array('pid' => $pid));
$acc_info = $req->fetch();

$pid = $acc_info['account_id'];
$userName = $acc_info['username'];
// $password = $resultat[''];
$firstName = $acc_info['firstname'];
$name = $acc_info['name'];
$description = $acc_info['description'];
$job = $acc_info['job'];
$email = $acc_info['email'];
$phone = $acc_info['phone'];
// $hire_date = $acc_info['hire_date'];
// $status = $acc_info['status'];

echo "
<div class='row center'>
    <div class='col s6 offset-s3'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Modification du profil</span>
            <div class='card-action'>
                <form action='script/s_edit_profile.php' method='post'>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input id='name' name='name' type='text' class='validate' value='$name'>
                        <label for='name'>Nom</label>
                    </div>
                    <div class='input-field col s6'>
                        <input id='firstName' name='firstName' type='text' class='validate' value='$firstName'>
                        <label for='firstName'>Prénom</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s6'>
                        <input id='email' name='email' type='text' class='validate' value='$email'>
                        <label for='email'>Adresse Email</label>
                    </div>
                    <div class='input-field col s6'>
                        <input id='phone' name='phone' type='tel' class='validate' maxlength='10' value='$phone'>
                        <label for='phone'>Numéro de téléphone</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field'>
                        <input id='job' name='job' type='text' class='validate' value='$job'>
                        <label for='job'>Travail actuel</label>
                    </div>
                </div>
                <div class='input-field'>
                    <textarea id='description' name='description' class='materialize-textarea'>$description</textarea>
                    <label for='description'>Courte description de vous</label>
                </div>
                    <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Modifier</button>
                </form>
                <div class = 'card-panel blue-grey'>
                <form action='script/upload_cv.php' method='post' enctype='multipart/form-data'>
                    <div class='file-field input-field'>
                        <div class='btn'>
                            <span>File</span>
                            <input type='file' name='cv' id='cv'>
                        </div>
                        <div class='file-path-wrapper'>
                            <input class='file-path validate' type='text' placeholder='Envoyez votre CV format PDF'>
                        </div>
                    </div>
                    <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Envoyer</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>

";

include_once("footer.php");
?>