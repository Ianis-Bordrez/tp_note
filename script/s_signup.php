<?php 
require_once('main_function.php');

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT username FROM account WHERE username = :username');
$req1->execute(array('username' => $_POST['userName']));
$resultat = $req1->fetch();

if ($resultat){
    echo "Un utilisateur porte d'ej`a  ce nom";
    header("Location: ../signup.php");
    exit();
}

$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$req = $bdd->prepare('INSERT INTO account (username, password, firstname, name, email, phone, status) VALUES (:username, :password, :firstname, :name, :email, :phone, :status)');
$req->execute(array(
    'username' => $_POST['userName'],
    'password' => $pass_hash,
    'firstname' => $_POST['firstName'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'status' => $_POST['status']
    ));

header("Location: ../login.php");
exit();