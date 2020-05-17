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

if (!file_exists("../cv")){
    mkdir("../cv/");
}

if (!file_exists("../cv/".$folder)){
        mkdir("../cv/".$folder);
    }

$destination = "../cv/$folder/cv.pdf";

// if(isset($_FILES["cv"])){
if(!empty($_FILES["cv"]['name'])){
    $file = file_get_contents($_FILES["cv"]["tmp_name"], NULL, NULL, 0, 5);

    if($file == "%PDF-"){
        if(!file_exists($destination)){
            move_uploaded_file($_FILES["cv"]["tmp_name"], "$destination");
        } else { 
            unlink($destination);
            move_uploaded_file($_FILES["cv"]["tmp_name"], "$destination");
        }
    }    
}


header("Location: ../profile.php");
exit();
?>