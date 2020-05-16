<?php 
require_once('main_function.php');

if(empty($_POST['userName']) || empty($_POST['password']) || empty($_POST['firstName']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['status'])){
    header('Location: ../signup.php');
    exit();
}

if (!isConnected()) {
    $bdd = mysqlConnect();

    $req = $bdd->prepare('SELECT username FROM account WHERE username = :username');
    $req->execute(array('username' => $_POST['userName']));
    $username = $req->fetch();

    if ($username){
        echo "Un utilisateur porte déjà  ce nom";
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
}

header('Location: ../login.php');
exit();
?>