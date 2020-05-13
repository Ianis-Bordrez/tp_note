<?php
require('main_function.php');

if (isConnected()) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

?>