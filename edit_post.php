<?php
require_once('script/main_function.php');


if (!isConnected()) {
    header('Location: login.php');
    exit;
}

$pid = $_GET['pid'];

if(!isset($pid)) {
    header("Location: ../home.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <body>
    <?php
    $bdd = mysqlConnect();

    $req1 = $bdd->prepare('SELECT * FROM posts WHERE post_id=:pid');
    $req1->execute(array(
        'pid' => $pid
    ));
    $resultat = $req1->fetch();

    $title = $resultat['title'];
    $content = $resultat['content'];

        echo "<form action='script/s_edit_post.php?pid=$pid' method='post'>";
        echo "<input placeholder='Titre' name='title' type='text' value='$title'><br>";
        echo "<textarea placeholder='Contenu' name='content' type='text'>$content</textarea><br>";
    ?>
            <input name="submit" type="submit" value="Modifier">
        </form>    
    </body>
</html>
