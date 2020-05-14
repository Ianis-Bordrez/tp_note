<?php
require_once('main_function.php');

if (isConnected()) {
    $bdd = mysqlConnect();

    $req = $bdd->prepare('INSERT INTO offer (title, content, account_id) VALUES (:title, :content, :account_id)');
    $req->execute(array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'account_id' => $_SESSION['account_id'],
        ));
}
header("Location: ../index.php");
exit();
