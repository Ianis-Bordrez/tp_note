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

    $req = $bdd->prepare('DELETE FROM posts WHERE id=:id');
    $req->execute(array(
    'id' => $_GET['pid']
    ));
    header("Location: ../home.php");
    exit;
?>