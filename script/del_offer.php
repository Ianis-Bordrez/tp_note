<?php
require_once('main_function.php');

if (isConnected()) {
    if(!isset($_POST['oid'])) {
        header("Location: ../index.php");
    exit();
    }

    $bdd = mysqlConnect();

    $req = $bdd->prepare('DELETE FROM offer WHERE offer_id=:oid');
    $req->execute(array('oid' => $_POST['oid']));

    $req2 = $bdd->prepare('SELECT * FROM offer_answer WHERE offer_id=:offer_id');
    $req2->execute(array('offer_id'=> $_POST['oid']));
    $answer = $req2->fetch();

    if ($answer){

        $req3 = $bdd->prepare('DELETE FROM offer_answer WHERE answ_id=:answ_id');
        $req3->execute(array('answ_id' => $answer['answ_id']));
        
        $req4 = $bdd->prepare('SELECT * FROM answer_answer WHERE answ_id=:answ_id');
        $req4->execute(array('answ_id'=> $answer['answ_id']));
        $answer_answer = $req4->fetch();

        if ($answer_answer){
            $req5 = $bdd->prepare('DELETE FROM answer_answer WHERE answer_answer=:answ_id');
            $req5->execute(array('answer_answer_id' => $answer_answer['answer_answer_id']));
        }
    }
}

header("Location: ../index.php");
exit();
?>