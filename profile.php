<?php

require_once('script/main_function.php');

if (!isConnected()) {
    header('Location: login.php');
    exit;
}

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM account where id=:id');
$req1->execute(array("id"=>$_SESSION['id']));
$resultat = $req1->fetch();

if ($resultat) {
    $userName = $resultat['username'];
    // $password = $resultat[''];
    $firstName = $resultat['firstname'];
    $name = $resultat['name'];
    $email = $resultat['email'];
    $hire_date = $resultat['hire_date'];
    $status = $resultat['status'];
    echo "
        <div>
            <h2>$userName</h2>
            <h2>$firstName</h2>
            <h2>$name</h2>
            <h2>$email</h2>
            <h2>$hire_date</h2>
            <h2>$status</h2>
        </div>
    ";
} else {
    echo "Utilisateur inexistant";
}

?>