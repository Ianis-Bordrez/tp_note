<?php

require_once('main_function.php');

if(!isConnected()){
    header("Location: ../login.php");
    exit;
}

if(!isset($_GET['pid'])) {
    header("Location: ../home.php");
    exit;
}

$bdd = mysqlConnect();

if (empty($_POST['firstName'] || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']))) {
    header("Location: ../profile.php");
    exit;
}

$req = $bdd->prepare('UPDATE account SET firstname=:firstname, name=:name, email=:email, phone=:phone WHERE account_id=:pid');
$req->execute(array(
    'firstname' => $_POST['firstName'],
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'pid' => $_GET['pid']
    ));

header("Location: ../profile.php");
exit;
