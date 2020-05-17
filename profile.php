<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$pid = $_SESSION['account_id'];
$canModify = true; 

if (isset($_GET['pid']))
{
    $pid = $_GET['pid'];
    $canModify = false;
}


$req = $bdd->prepare('SELECT * FROM account where account_id=:id');
$req->execute(array("id"=> $pid));
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
                    <span class='card-title'>Profil</span>
                    <blockquote>Nom d'utilisateur : $userName</blockquote>
                    <blockquote>Prénom : $firstName</blockquote>
                    <blockquote>Nom : $name</blockquote>
                    <blockquote>Déscirption : $description</blockquote>
                    <blockquote>Travail : $job</blockquote>
                    <blockquote>Email : $email</blockquote>
                    <blockquote>Numéro de téléphone : $phone</blockquote>
                    <blockquote>Date de création du compte : $create_date</blockquote>
                    ";
                    
                    $folder = strtolower($firstName."_".$name);
                    $destination = "cv/$folder/cv.pdf";
                    

                    if(file_exists($destination)){
                    echo "
                        <form action='script/show_cv.php' method='post' >
                        <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Voir le CV</button>
                        </form>
                    ";
                    } else {
                        echo"
                            <blockquote>Aucun CV</blockquote>
                        ";
                    }
                    
                    if($canModify || $_SESSION['status'] == "ADMIN") {
                    echo "
                    <form action='edit_profile.php' method='post'>
                        <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Modifier</button>
                    </form>
                    ";
                    }
                    echo "
                </div>
            </div>
        </div>
    ";

    if ($acc_info['status'] == 'ENTREPRISE') {
        $req2 = $bdd->prepare('SELECT * FROM company where boss_id=:id');
        $req2->execute(array("id"=> $pid));
        $comp_info = $req2->fetch();

        if ($comp_info){
            $cid = $comp_info['company_id'];
            $comp_name = $comp_info['name'];
            $comp_desc = $comp_info['description'];
            $comp_memb = $comp_info['member'];
            $comp_activity = $comp_info['activity_area'];

    echo "
        <div class='col s4 offset-s2'>
            <div class='card blue-grey darken-1'>
                <div class='card-content white-text'>
                    <span class='card-title'>Entreprise</span>
                    <blockquote>Nom : $comp_name</blockquote>
                    <blockquote>Description : $comp_desc</blockquote>
                    <blockquote>Nombre de membre : $comp_memb</blockquote>
                    <blockquote>Domaine d'activité : $comp_activity</blockquote>";
                if($canModify  || $_SESSION['status'] == "ADMIN") {
                    echo "
                <form action='edit_company.php' method='post'>
                    <button class='btn waves-effect waves-light' type='submit' name='cid' value='$cid'>Modifier</button>
                </form>";
                }
                echo"
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
                    <button class='btn waves-effect waves-light' type='submit' name='cid' value='$cid'>Créer</button>
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