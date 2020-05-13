<?php
require_once('script/main_function.php');


if (!isConnected()) {
    header('Location: login.php');
    exit;
}
?>
<form action="script/s_logout.php" method="post">
<button type="submit">D'econnexion</button>
</form>