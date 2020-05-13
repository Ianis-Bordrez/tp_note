<?php

require_once('main_function.php');

$bdd = mysqlConnect();

$req = $bdd->prepare('INSERT INTO posts (title, content, owner) VALUES (:title, :content, :owner)');
$req->execute(array(
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'owner' => $_SESSION['userName'],
    ));

header("Location: ../home.php");
exit;
