<?php

require_once('main_function.php');

isNotConnectedRedirect("../login.php");

if(!isset($_GET['pid'])) {
    header("Location: ../index.php");
    exit();
}

if (empty($_POST['name'])) {
    header("Location: ../profile.php");
    exit();
}

$bdd = mysqlConnect();

$req = $bdd->prepare('UPDATE company SET name=:name, description=:description, member=:nbrPersonnals, activity_area=:activityArea WHERE company_id=:pid');
$req->execute(array(
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'nbrPersonnals' => $_POST['nbrPersonnals'],
    'activityArea' => $_POST['activityArea'],
    'pid' => $_GET['pid']
    ));

header("Location: ../index.php");
exit();