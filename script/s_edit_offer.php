<?php

require_once('main_function.php');

isNotConnectedRedirect("../login.php");

if (isConnected()) {
    if(!isset($_POST['oid'])) {
        header("Location: ../index.php");
        exit();
    }

    $bdd = mysqlConnect();

    if (empty($_POST['title'] || empty($_POST['content']))) {
        header("Location: ../index.php");
        exit();
    }

    $req = $bdd->prepare('UPDATE offer SET title=:title, content=:content WHERE offer_id=:oid');
    $req->execute(array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'oid' => $_POST['oid']
        ));
}

header("Location: ../index.php");
exit();
?>