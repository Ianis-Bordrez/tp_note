<?php
require_once('main_function.php');

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT id, userName, password, status FROM account WHERE userName = :userName');
$req->execute(array(
    'userName' => $_POST['userName']));
$resultat = $req->fetch();

$isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);

if ($resultat) {
    if ($isPasswordCorrect) {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['userName'] = $resultat['userName'];
        $_SESSION['status'] = $resultat['status'];
        header('Location: ../index.php');
        exit;
    }
}
// echo 'Mauvais identifiant ou mot de passe !';
header("Location: ../login.php");
exit;
?>