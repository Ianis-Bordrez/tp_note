<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM account where account_id=:id');
$req->execute(array("id"=>$_SESSION['account_id']));
$acc_info = $req->fetch();

if ($acc_info) {
    $id = $acc_info['account_id'];
    $userName = $acc_info['username'];
    $firstName = $acc_info['firstname'];
    $name = $acc_info['name'];
    $description = $acc_info['description'];
    $job = $acc_info['job'];
    $email = $acc_info['email'];
    $phone = $acc_info['phone'];
    $create_date = $acc_info['create_date'];
    echo "
    <div class='row'>
        <div class='col s4 offset-s1'>
            <div class='card blue-grey darken-1'>
                <div class='card-content white-text'>
                    <span class='card-title'>Votre profil</span>
                    <blockquote>Nom d'utilisateur : $userName</blockquote>
                    <blockquote>Prénom : $firstName</blockquote>
                    <blockquote>Nom : $name</blockquote>
                    <blockquote>Déscirption : $description</blockquote>
                    <blockquote>Travail : $job</blockquote>
                    <blockquote>Email : $email</blockquote>
                    <blockquote>Numéro de téléphone : $phone</blockquote>
                    <blockquote>Date de création du compte : $create_date</blockquote>
                    <form action='edit_profile.php' method='post'>
                        <button class='btn waves-effect waves-light' type='submit'>Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    ";

    if ($acc_info['status'] == 'ENTREPRISE') {
        $req2 = $bdd->prepare('SELECT * FROM company where boss_id=:id');
        $req2->execute(array("id"=>$_SESSION['account_id']));
        $comp_info = $req2->fetch();

        if ($comp_info){
            $comp_name = $comp_info['name'];
            $comp_desc = $comp_info['description'];
            $comp_memb = $comp_info['member'];
            $comp_activity = $comp_info['activity_area'];

    echo "
        <div class='col s4 offset-s2'>
            <div class='card blue-grey darken-1'>
                <div class='card-content white-text'>
                    <span class='card-title'>Votre entreprise</span>
                    <blockquote>Nom : $comp_name</blockquote>
                    <blockquote>Description : $comp_desc</blockquote>
                    <blockquote>Nombre de membre : $comp_memb</blockquote>
                    <blockquote>Domaine d'activité : $comp_activity</blockquote>
                <form action='edit_company.php' method='post'>
                    <button class='btn waves-effect waves-light' type='submit'>Modifier</button>
                </form>
            </div>
        </div>
    </div>
    ";
        } else {
    echo "
        <div class='col s4 offset-s2'>
            <div class='card blue-grey darken-1'>
                <div class='card-content white-text'>
                    <span class='card-title'>Vous n'avez pas créer votre entreprise</span>
                <form action='company.php' method='post'>
                    <button class='btn waves-effect waves-light' type='submit'>Créer</button>
                </form>
            </div>
        </div>
    </div>
    ";
} 
    }
} else {
    echo "Utilisateur inexistant";
}

include_once("footer.php");
?>