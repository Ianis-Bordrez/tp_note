<?php
include_once("header.php");

$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM offer ORDER BY offer_id DESC');
$req1->execute();
$resultat = $req1->fetchall();

if ($resultat) {
    foreach($resultat as $row){
        $id = $row['offer_id'];
        $title = $row['title'];
        $content = $row['content'];
        $date = $row['offer_date'];
        $admin = "<div>
                    <a href='script/del_offer.php?pid=$id'>Suppr</a>
                    <a href='edit_offer.php?pid=$id'>Modif</a>
                  </div>";
        echo "<div> 
                <h2>$title</h2>
                <p>$content</p>
                <p>$date</p>
               </div>".$admin."<hr>";
    }
} else {
    echo "Il n'y a pas d'offre pour le moment..";
}

include_once("footer.php");
?>