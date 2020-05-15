<?php
require_once('main_function.php');

$oid = $_POST['oid'];

if(!isset($oid)) {
    header('Location: index.php');
    exit();
}

if(empty($_POST['response'])){
    header('Location: index.php');
    exit();
}

if (isConnected()) {
    $bdd = mysqlConnect();

    $req = $bdd->prepare('INSERT INTO offer_response (offer_id, account_id, response) VALUES (:offer_id, :account_id, :response)');
    $req->execute(array(
        'offer_id' => $oid,
        'account_id' => $_SESSION['account_id'],
        'response' => $_POST['response']
        ));
}
header("Location: ../index.php");
exit();
