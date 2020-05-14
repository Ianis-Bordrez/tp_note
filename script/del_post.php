<?php
require_once('main_function.php');

if (isConnected()) {
    if(!isset($_GET['pid'])) {
        header("Location: ../index.php");
    exit();
    }

    $bdd = mysqlConnect();

    $req = $bdd->prepare('DELETE FROM posts WHERE post_id=:id');
    $req->execute(array(
    'id' => $_GET['pid']
    ));
}

header("Location: ../index.php");
exit();
?>