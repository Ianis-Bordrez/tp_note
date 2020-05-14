<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM offer_response WHERE account_id=:account_id ORDER BY resp_id DESC');
$req->execute(array('account_id'=> $_SESSION['account_id']));
$responses = $req->fetchall();
if ($responses) {
    foreach($responses as $response){
        $offer_id = $response['offer_id'];

        $req2 = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:offer_id');
        $req2->execute(array('offer_id'=> $offer_id));
        $offer = $req2->fetch();   
        
        if($offer){
            $title = $offer['title'];
            $content = $offer['content'];
            $offer_date = $offer['offer_date'];

            $resp_text = $response['response'];
            $resp_date = $response['response_date'];

            echo "
                <div> 
                    <h2>L'offre</h2>
                    <p>$title</p>
                    <p>$content</p>
                    <p>$offer_date</p>
                </div>";
            echo "
                <div> 
                    <h2>Votre réponse</h2>
                    <p>$resp_text</p>
                    <p>$resp_date</p>
                </div>";
        }
    }
} else {
    echo "Vous n'avez répondu à aucune offre.";
}

include_once("footer.php");
?>