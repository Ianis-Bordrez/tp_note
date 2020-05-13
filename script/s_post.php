<?php

require_once('main_function.php');

$bdd = mysqlConnect();

$req = $bdd->prepare('INSERT INTO posts (title, content, account_id) VALUES (:title, :content, :account_id)');
$req->execute(array(
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'account_id' => $_SESSION['account_id'],
    ));

header("Location: ../home.php");
exit;
