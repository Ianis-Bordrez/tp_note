<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();
$req = $bdd->prepare('SELECT * FROM offer ORDER BY offer_id DESC');
$req->execute();
$offers = $req->fetchall();

if ($offers) {
    foreach($offers as $offer){
        $offer_id = $offer['offer_id'];

        $title = $offer['title'];
        $content = $offer['content'];
        $offer_date = $offer['offer_date'];

        echo "
            <div class='row'>
                <div class='col s12 m6'>
                    <div class='card blue-grey darken-1'>
                        <div class='card-content white-text'>
                            <span class='card-title'>$title</span>
                            <blockquote>$content</blockquote>
                            <p>$offer_date</p>
                            <div class='card-action'>
                                <div class='row'>
                                    <div class='input-field col'>
                                    <form action='script/del_offer.php' method='post'>
                                        <button class='btn waves-effect waves-light' type='submit' name='oid' value='$offer_id'>Supprimer</button>
                                    </form>
                                    </div>
                                    <div class='input-field col'>
                                    <form action='edit_offer.php' method='post'>
                                        <button class='btn waves-effect waves-light' type='submit' name='oid' value='$offer_id'>Modifier</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        
                        ";

                        $req2 = $bdd->prepare('SELECT * FROM offer_answer WHERE offer_id=:offer_id');
                        $req2->execute(array('offer_id'=> $offer_id));
                        $answers = $req2->fetchall();
                        foreach($answers as $answer) {
                            if($answer){
                                $rid = $answer['answ_id'];
                                $answ_owner_id = $answer['account_id'];
                                $answ_text = $answer['answer'];
                                $answ_date = $answer['answer_date'];
                                $req3 = $bdd->prepare('SELECT account_id,username FROM account WHERE account_id=:answ_owner_id');
                                $req3->execute(array('answ_owner_id'=> $answ_owner_id));
                                $answ_owner_info = $req3->fetch();
                                $answ_owner_username = $answ_owner_info['username'];
                                echo"
                            <div class = 'card-panel blue-grey'>
                                <p>Réponse de $answ_owner_username<p>
                                <blockquote class='blue-grey'>$answ_text</blockquote>
                                <p>$answ_date</p>
                                <div>";
                                $req4 = $bdd->prepare('SELECT answ_id FROM answer_answer WHERE answ_id=:rid');
                                $req4->execute(array('rid'=> $rid));
                                $answer_answer = $req4->fetch();

                                if(!$answer_answer){
                                    echo "<form action='answ_offer.php' method='post'>
                                    <button class='btn waves-effect waves-light' type='submit' name='rid' value='$rid'>Répondre
                                        <i class='material-icons right'>send</i>
                                    </button>
                                    </form>
                                    ";
                                }
                                echo "
                                </div>
                            
                                ";
                                $req3 = $bdd->prepare('SELECT * FROM answer_answer WHERE answ_id=:answ_id');
                                $req3->execute(array('answ_id'=> $rid));
                                $answer2 = $req3->fetch();
                                if($answer2){
                                    $resp2_text = $answer2['answer'];
                                    $resp2_date = $answer2['answer_date'];
                                    echo"
                            <div class = 'card-panel blue-grey darken-1'>
                                <p>Votre réponse<p>
                                <blockquote class='blue-grey darken-1'>$resp2_text</blockquote>
                                <p>$resp2_date</p>
                            </div>
                                    ";
                                }
                            }
                        }
                        echo "
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "Vous n'avez posté aucune offre.";
}

include_once("footer.php");
?>