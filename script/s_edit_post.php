<?php

require_once('main_function.php');

if(!isset($_SESSION['userName'])){
    header("Location: ../login.php");
    exit;
}

if(!isset($_GET['pid'])) {
    header("Location: ../home.php");
    exit;
}

$bdd = mysqlConnect();

if (empty($_POST['title'] || empty($_POST['content']))) {
    header("Location: ../home.php");
    exit;
}

$req = $bdd->prepare('UPDATE posts SET title=:title, content=:content WHERE id=:pid');
$req->execute(array(
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'pid' => $_GET['pid']
    ));

header("Location: ../home.php");
exit;
