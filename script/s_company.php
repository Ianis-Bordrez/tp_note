<?php
require_once('main_function.php');

if (isConnected()) {
    $bdd = mysqlConnect();

    $req = $bdd->prepare('INSERT INTO company (boss_id, name, description, member, activity_area) VALUES (:boss_id, :name, :description, :member, :activity_area)');
    $req->execute(array(
        'boss_id' => $_SESSION['account_id'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'member' => $_POST['nbrPersonnals'],
        'activity_area' => $_POST['activityArea'],
        ));
}
header("Location: ../profile.php");
exit();