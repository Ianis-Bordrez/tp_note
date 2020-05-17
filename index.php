<?php
include_once("header.php");

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM offer ORDER BY offer_id DESC');
$req->execute();
$offers = $req->fetchall();

if ($offers) {
    foreach($offers as $offer){
        $title = $offer['title'];
        $content = $offer['content'];
        $date = $offer['offer_date'];

        $req3 = $bdd->prepare('SELECT account_id,username FROM account WHERE account_id=:offer_owner_id');
        $req3->execute(array('offer_owner_id'=> $offer['account_id']));
        $offer_owner_info = $req3->fetch();

        $offer_owner_username = $offer_owner_info['username'];
        $offer_owner_id = $offer_owner_info['account_id'];

        echo "
            <div class='row'>
                <div class='col s12 m6'>
                    <div class='card blue-grey darken-1'>
                        <div class='card-content white-text'>
                            <p>Offre de <a href='profile.php?pid=$offer_owner_id'>$offer_owner_username</a></p>
                            <span class='card-title'>$title</span>
                            <blockquote>$content</blockquote>
                            <p>$date</p>
                        </div>";
        if (isConnected()){
            if ($_SESSION['account_id'] == $offer['account_id'] || $_SESSION['status'] == 'ADMIN') {
                $oid = $offer['offer_id'];
                echo "
                    <div class='card-action'>
                        <div class='row'>
                            <div class='input-field col'>
                            <form action='script/del_offer.php' method='post'>
                                <button class='btn waves-effect waves-light' type='submit' name='oid' value='$oid'>Supprimer</button>
                            </form>
                            </div>
                            <div class='input-field col'>
                            <form action='edit_offer.php' method='post'>
                                <button class='btn waves-effect waves-light' type='submit' name='oid' value='$oid'>Modifier</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    ";
            } else if ($_SESSION['status'] == 'CANDIDAT') {
                $oid = $offer['offer_id'];
                $req2 = $bdd->prepare('SELECT * FROM offer_answer WHERE offer_id=:offer_id AND account_id=:account_id');
                $req2->execute(array(
                    'offer_id'=> $oid,
                    'account_id'=> $_SESSION['account_id']
                ));
                $answer_info = $req2->fetch();
                if (!$answer_info) {
                    echo "
                        <div>
                            <form action='answ_offer.php' method='post'>
                            <button class='btn waves-effect waves-light' type='submit' name='oid' value='$oid'>Répondre
                                <i class='material-icons right'>send</i>
                            </button>
                            </form>
                        </div>
                    ";
                }
            }
        }
        echo"
                    </div>
                </div>
            </div>
        ";
                    
    }
} else {
    echo "Il n'y a pas d'offre pour le moment..";
}

include_once("footer.php");
?>
