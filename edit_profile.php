<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM account WHERE account_id=:pid');
$req1->execute(array('pid' => $_SESSION['account_id']));
$resultat = $req1->fetch();

$id = $resultat['account_id'];
$userName = $resultat['username'];
// $password = $resultat[''];
$firstName = $resultat['firstname'];
$name = $resultat['name'];
$description = $resultat['description'];
$job = $resultat['job'];
$email = $resultat['email'];
$phone = $resultat['phone'];
// $hire_date = $resultat['hire_date'];
// $status = $resultat['status'];

echo "
    <form action='script/s_edit_profile.php?pid=$pid' method='post'>
        <input placeholder='Prénom' name='firstName' type='text' value='$firstName'><br>
        <input placeholder='Nom' name='name' type='text' value='$name'><br>
        <textarea placeholder='Courte descritption' name='content' type='text'>$description</textarea><br>
        <input placeholder='Travail' name='job' type='text' value='$job'><br>
        <input placeholder='Email' name='email' type='text' value='$email'><br>
        <input placeholder='Téléphone' name='phone' type='text' value='$phone'><br>
        <input name='submit' type='submit' value='Modifier'>
    </form>
";

include_once("footer.php");
?>