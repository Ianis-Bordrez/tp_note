<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM account where account_id=:id');
$req1->execute(array("id"=>$_SESSION['account_id']));
$resultat = $req1->fetch();

if ($resultat) {
    $id = $resultat['account_id'];
    $userName = $resultat['username'];
    // $password = $resultat[''];
    $firstName = $resultat['firstname'];
    $name = $resultat['name'];
    $description = $resultat['description'];
    $job = $resultat['job'];
    $email = $resultat['email'];
    $phone = $resultat['phone'];
    $create_date = $resultat['create_date'];
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
            <a href='edit_profile.php?pid=$id'>Modifier</a>
            </div>
        </div>
    ";
} else {
    echo "Utilisateur inexistant";
}

include_once("footer.php");
?>