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
        echo "
            <div> 
                <h2>$title</h2>
                <p>$content</p>
                <p>$date</p>
            </div>";

        if (isConnected()){
            if ($_SESSION['account_id'] == $offer['account_id'] || $_SESSION['status'] == 'ADMIN') {
                $oid = $offer['offer_id'];
                echo "
                    <div>
                        <form action='script/del_offer.php' method='post'>
                            <button type='submit' name='oid' value='$oid'>Supprimer</button>
                        </form>
                        <form action='edit_offer.php' method='post'>
                            <button type='submit' name='oid' value='$oid'>Modifier</button>
                        </form>
                    </div>
                    
                    ";
            } else if ($_SESSION['status'] == 'CANDIDAT') {
                $id = $offer['offer_id'];
                echo "
                <div>
                    <a href='rep_offer.php?pid=$id'>Répondre</a>
                </div>
                ";
            }
        }
        echo "<hr>";
    }
} else {
    echo "Il n'y a pas d'offre pour le moment..";
}

include_once("footer.php");
?>