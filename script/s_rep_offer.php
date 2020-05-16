<?php
require_once('main_function.php');

if (isset($_POST['oid'])){
    $oid = $_POST['oid'];
}
elseif (isset($_POST['rid'])){
    $rid = $_POST['rid'];
} else{
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

if(empty($_POST['answer'])){
    header('Location: ../index.php');
    exit();
}

if (isConnected()) {
    $bdd = mysqlConnect();
    if ($rid){
        $req = $bdd->prepare('INSERT INTO answ_resp (answ_id, account_id, answer) VALUES (:id, :account_id, :answer)');
        $id = $rid;

    } else {
        $req = $bdd->prepare('INSERT INTO offer_answer (offer_id, account_id, answer) VALUES (:id, :account_id, :answer)');
        $id = $oid;
    }
    $req->execute(array(
        'id' => $id,
        'account_id' => $_SESSION['account_id'],
        'answer' => $_POST['answer']
        ));
}
header("Location: ../index.php");
exit();
