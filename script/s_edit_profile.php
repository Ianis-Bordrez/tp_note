<?php

require_once('main_function.php');

isNotConnectedRedirect("../login.php");

if(!isset($_GET['pid'])) {
    header("Location: ../index.php");
    exit();
}

$bdd = mysqlConnect();

if (empty($_POST['$name'] || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']))) {
    header("Location: ../profile.php");
    exit();
}

$req = $bdd->prepare('UPDATE account SET firstname=:firstname, name=:name, description=:description, job=:job, email=:email, phone=:phone WHERE account_id=:pid');
$req->execute(array(
    'firstname' => $_POST['firstName'],
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'job' => $_POST['job'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'pid' => $_GET['pid']
    ));

header("Location: ../profile.php");
exit();
