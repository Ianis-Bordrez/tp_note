<?php 

require_once('main_function.php');

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT login, password FROM account WHERE login = :login');
$req1->execute(array(
    'login' => $_POST['login']));
$resultat = $req1->fetch();

if ($resultat){
    echo "Un utilisateur porte d~A(c)j~A  ce nom";
    header("Location: ../signup.php");
    exit;
}

$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$req = $bdd->prepare('INSERT INTO account (username, password, firstname, name, email, status) VALUES (:username, :password, :firstname, :name, :email, :status)');
$req->execute(array(
    'username' => $_POST['userName'],
    'password' => $pass_hash,
    'firstname' => $_POST['firstName'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'status' => $_POST['status']
    ));

header("Location: ../index.php");
exit;