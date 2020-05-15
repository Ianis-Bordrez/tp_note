<?php
require_once('main_function.php');

if (isConnected()) {
    if(!isset($_POST['oid'])) {
        header("Location: ../index.php");
    exit();
    }

    $bdd = mysqlConnect();

    $req = $bdd->prepare('DELETE FROM offer WHERE offer_id=:oid');
    $req->execute(array(
    'oid' => $_POST['oid']
    ));
}

header("Location: ../index.php");
exit();
?>