<?php
include_once("header.php");

isNotConnectedRedirect();

$bdd = mysqlConnect();
$req = $bdd->prepare('SELECT * FROM offer WHERE account_id=:account_id ORDER BY offer_id DESC');
$req->execute(array('account_id'=> $_SESSION['account_id']));
$offers = $req->fetchall();

if ($offers) {
    foreach($offers as $offer){
        $offer_id = $offer['offer_id'];

        $title = $offer['title'];
        $content = $offer['content'];
        $offer_date = $offer['offer_date'];

        echo "
                <div> 
                    <h2>Offre :</h2>
                    <p>$title</p>
                    <p>$content</p>
                    <p>$offer_date</p>
                </div>";
                $id = $offer['offer_id'];
                echo "
                    <div>
                        <a href='script/del_offer.php?pid=$id'>Supprimer</a>
                        <a href='edit_offer.php?pid=$id'>Modifer</a>
                    </div>
                    ";

        $req2 = $bdd->prepare('SELECT * FROM offer_response WHERE offer_id=:offer_id');
        $req2->execute(array('offer_id'=> $offer_id));
        $response = $req2->fetch();
        
        if($response){
            $resp_text = $response['response'];
            $resp_date = $response['response_date'];

            echo "
                <div> 
                    <h2>Réponses</h2>
                    <p>$resp_text</p>
                    <p>$resp_date</p>
                </div>";
        } else {
            echo "Aucune réponse";
        }
    }
} else {
    echo "Vous n'avez répondu à aucune offre.";
}

include_once("footer.php");
?>