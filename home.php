<?php
require_once('script/main_function.php');

if (!isConnected()) {
    header('Location: index.php');
    exit;
}


$bdd = mysqlConnect();

$req1 = $bdd->prepare('SELECT * FROM posts ORDER BY post_id DESC');
$req1->execute();
$resultat = $req1->fetchall();

if ($resultat) {
    foreach($resultat as $row){
        $id = $row['post_id'];
        $title = $row['title'];
        $content = $row['content'];
        $date = $row['post_date'];
        $admin = "<div>
                    <a href='script/del_post.php?pid=$id'>Suppr</a>
                    <a href='edit_post.php?pid=$id'>Modif</a>
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

?>