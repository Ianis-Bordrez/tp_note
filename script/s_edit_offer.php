<?php

require_once('main_function.php');

isNotConnectedRedirect();


if(!isset($_POST['oid'])) {
    header("Location: ../index.php");
    exit();
}

if (empty($_POST['title']) || empty($_POST['content'])) {
    header("Location: ../my_offer.php");
    exit();
}

$bdd = mysqlConnect();

$req = $bdd->prepare('UPDATE offer SET title=:title, content=:content WHERE offer_id=:oid');
$req->execute(array(
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'oid' => $_POST['oid']
    ));

header("Location: ../index.php");
exit();
?>