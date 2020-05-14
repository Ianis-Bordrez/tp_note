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
        <div>
            <div>
                <h2>$userName</h2>
                <h2>$firstName</h2>
                <h2>$name</h2>
                <h2>$description</h2>
                <h2>$job</h2>
                <h2>$email</h2>
                <h2>$phone</h2>
                <h2>$create_date</h2>
            </div>
            <div>
            <a href='edit_profile.php'>Modifier</a>
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
            <div>
                <div>
                    <h2>$comp_name</h2>
                    <p>$comp_desc</p>
                    <p>$comp_memb</p>
                    <p>$comp_activity</p>
                </div>
                <div>
                    <a href='edit_company.php'>Modifier</a>
                </div>
            </div>
            ";
        } else {
            echo "Vous n'avez pas créer votre entreprise.";
            echo "<a href='company.php'>Créer</a>";
        } 
    }
} else {
    echo "Utilisateur inexistant";
}

include_once("footer.php");
?>