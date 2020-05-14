<?php
include_once("header.php");

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM offer ORDER BY offer_id DESC');
$req1->execute();
$offers = $req1->fetchall();

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
            if ($_SESSION['account_id'] == $offer['account_id'] || $_SESSION['status'] == "ADMIN") {
                $id = $offer['offer_id'];
                echo "
                    <div>
                        <a href='script/del_offer.php?pid=$id'>Suppr</a>
                        <a href='edit_offer.php?pid=$id'>Modif</a>
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