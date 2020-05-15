<?php

require_once('main_function.php');

if (isConnected()) {
    if (!empty($_POST['firstName'] || !empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['phone']))) {

        if (isset($_POST['pid'])){
            $pid = $_POST['pid'];
        } else {
            $pid = $_SESSION['account_id'];
        }

        $bdd = mysqlConnect();
        $req = $bdd->prepare('UPDATE account SET firstname=:firstname, name=:name, description=:description, job=:job, email=:email, phone=:phone WHERE account_id=:pid');
        $req->execute(array(
        'firstname' => $_POST['firstName'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'job' => $_POST['job'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'pid' => $pid
        ));
    }
}

if (isset($_POST['pid'])){
    header("Location: ../all_profile.php");
} else {
    header("Location: ../profile.php");
}

exit();
?>