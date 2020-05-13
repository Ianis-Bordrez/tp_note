<?php

require_once('script/main_function.php');

if (!isConnected()) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <body>
        <form action="script/s_post.php" method="post">
            <input placeholder="Titre" name="title" type="text"><br>
            <textarea placeholder="Contenu" name="content" type="text"></textarea><br>
            <input name="submit" type="submit" value="Poster">
        </form>
    </body>
</html>