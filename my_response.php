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

        $req2 = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:offer_id');
        $req2->execute(array('offer_id'=> $offer_id));
        $offer = $req2->fetch();   
        
        if($offer){
            $title = $offer['title'];
            $content = $offer['content'];
            $offer_date = $offer['offer_date'];

            $answ_text = $answer['answer'];
            $answ_date = $answer['answer_date'];

            echo "
                <div class='row'>
                    <div class='col s12 m6'>
                        <div class='card blue-grey darken-1'>
                            <div class='card-content white-text'>
                                <span class='card-title'>$title</span>
                                <blockquote>$content</blockquote>
                                <p>$offer_date</p>
                                <div class = 'card-panel blue-grey'>
                                    <blockquote class='blue-grey'>$answ_text</blockquote>
                                    <p>$answ_date</p>
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