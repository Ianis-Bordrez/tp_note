<?php
require_once('main_function.php');

if (!isConnected()) {
    $bdd = mysqlConnect();

    $req = $bdd->prepare('SELECT account_id, username, password, status FROM account WHERE username = :username');
    $req->execute(array('username' => $_POST['userName']));
    $acc_info = $req->fetch();

    if ($acc_info) {
        $isPasswordCorrect = password_verify($_POST['password'], $acc_info['password']);
        if ($isPasswordCorrect) {
            $_SESSION['account_id'] = $acc_info['account_id'];
            $_SESSION['username'] = $acc_info['username'];
            $_SESSION['status'] = $acc_info['status'];
            header('Location: ../index.php');
            exit();
        }
    }
}
header("Location: ../login.php");
exit();
?>