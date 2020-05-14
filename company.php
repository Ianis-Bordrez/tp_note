<?php
include_once("header.php");

isNotConnectedRedirect();

if ($_SESSION['status'] != "ENTREPRISE") {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$bdd = mysqlConnect();
$req = $bdd->prepare('SELECT company_id FROM company WHERE boss_id = :id');
$req->execute(array('id' => $_SESSION['account_id']));
$company = $req->fetch();

if ($company) {
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

echo "
    <form action='script/s_company.php' method='post'>
        <input placeholder='Nom' name='name' type='text'><br>
        <textarea placeholder='Description' name='description' type='text'></textarea><br>
        <input placeholder='Nombre de personnels' name='nbrPersonnals' type='text'><br>
        <input placeholder=\"Domaine d'activité\" name='activityArea' type='text'><br>
        <input name='submit' type='submit' value='Créer'>
    </form>
";

include_once("footer.php");
?>