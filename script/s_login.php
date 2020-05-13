<?php
require_once('main_function.php');

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT account_id, username, password, status FROM account WHERE username = :username');
$req->execute(array(
    'username' => $_POST['userName']));
$resultat = $req->fetch();

if ($resultat) {
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
    if ($isPasswordCorrect) {
        $_SESSION['account_id'] = $resultat['account_id'];
        $_SESSION['username'] = $resultat['username'];
        $_SESSION['status'] = $resultat['status'];
        header('Location: ../index.php');
        exit();
    }
}
// echo 'Mauvais identifiant ou mot de passe !';
header("Location: ../login.php");
exit();
?>