<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM offer_answer WHERE account_id=:account_id ORDER BY answ_id DESC');
$req->execute(array('account_id'=> $_SESSION['account_id']));
$answers = $req->fetchall();
if ($answers) {
    foreach($answers as $answer){
        $offer_id = $answer['offer_id'];
        $rid = $answer['answ_id'];
        $isAccepted = $answer['isAccepted'];

        $req2 = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:offer_id');
        $req2->execute(array('offer_id'=> $offer_id));
        $offer = $req2->fetch();
        if($offer){
            $title = $offer['title'];
            $content = $offer['content'];
            $offer_date = $offer['offer_date'];
            $offer_owner_id = 

            $req5 = $bdd->prepare('SELECT account_id,username FROM account WHERE account_id=:offer_owner_id');
            $req5->execute(array('offer_owner_id'=> $offer['account_id']));
            $offer_owner_info = $req5->fetch();

            $offer_owner_id = $offer_owner_info['account_id'];
            $offer_owner_username = $offer_owner_info['username'];

            $answ_text = $answer['answer'];
            $answ_date = $answer['answer_date'];
            echo "
                <div class='row'>
                    <div class='col s12 m6 '>
                        <div class='card blue-grey darken-1'>";
                        if ($isAccepted){
                            echo "<div class='card-content white-text blink-bg'>"; // Ce petit blinking qui fait plaisir
                        }
                        else {
                            echo "<div class='card-content white-text'>";
                        }
                        echo "
                                <p>Offre de <a href='profile.php?pid=$offer_owner_id'>$offer_owner_username</a><p>
                                <span class='card-title'>$title</span>
                                <blockquote>$content</blockquote>
                                <p>$offer_date</p>
                                <div class = 'card-panel blue-grey'>
                                    <p>Votre réponse</p>
                                    <blockquote class='blue-grey'>$answ_text</blockquote>
                                    <p>$answ_date</p>
                                ";
                                $req3 = $bdd->prepare('SELECT * FROM answer_answer WHERE answ_id=:answ_id');
                                $req3->execute(array('answ_id'=> $rid));
                                $answer2 = $req3->fetch();
                                if($answer2){
                                    $resp2_text = $answer2['answer'];
                                    $resp2_date = $answer2['answer_date'];

                                    $req4 = $bdd->prepare('SELECT account_id,username FROM account WHERE account_id=:answ_owner_id');
                                    $req4->execute(array('answ_owner_id'=> $answer2['account_id']));
                                    $answ2_owner_info = $req4->fetch();
                                    $answ2_owner_username = $answ2_owner_info['username'];
                                    
                                    echo"
                                <div class = 'card-panel blue-grey darken-1'>
                                    <p>Réponse de $answ2_owner_username<p>
                                    <blockquote class='blue-grey darken-1'>$resp2_text</blockquote>
                                    <p>$resp2_date</p>
                                </div>
                                        ";
                                    }
                                echo "
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }
} else {
    echo "Vous n'avez répondu à aucune offre.";
}

include_once("footer.php");
?>