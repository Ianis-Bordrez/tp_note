<?php
require_once('main_function.php');

isNotConnectedRedirect();

$pid = $_SESSION['account_id'];

if (isset($_POST['pid'])){
    $pid = $_POST['pid'];
}

$bdd = mysqlConnect();
$req = $bdd->prepare('SELECT firstname, name FROM account WHERE account_id =:account_id');
$req->execute(array("account_id"=> $pid));
$account_info = $req->fetch();

$folder = strtolower($account_info["firstname"]."_".$account_info["name"]);

$destination = "../cv/$folder/cv.pdf";

header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=$destination");
header("Content-Transfert-Encoding: binary");
header("Accept-Ranges: bytes");
@readfile($destination);
?>