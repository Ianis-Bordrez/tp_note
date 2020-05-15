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
    <form action='script/s_edit_profile.php' method='post'>
        <input placeholder='Prénom' name='firstName' type='text' value='$firstName'><br>
        <input placeholder='Nom' name='name' type='text' value='$name'><br>
        <textarea placeholder='Courte description' name='description' type='text'>$description</textarea><br>
        <input placeholder='Travail' name='job' type='text' value='$job'><br>
        <input placeholder='Email' name='email' type='text' value='$email'><br>
        <input placeholder='Téléphone' name='phone' type='text' value='$phone'><br>
        <button type='submit' name='pid' value='$pid'>Modifier</button>
    </form>
";

include_once("footer.php");
?>