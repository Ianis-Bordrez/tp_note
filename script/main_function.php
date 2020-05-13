<?php

session_start();

function isConnected() {
    if (isset($_SESSION['username'])) {
        return True;
    }
    return False;
}

function isConnectedRedirect($page = 'index.php') {
    /**
     * Fonction de bidouillage pour corriger le warning : Cannot modify header information - headers already sent by
     * 
     * Permet de rediriger l'utilisateur connecté sur une autre page passé en paramètre après que le headers soit créé.
     * 
    */
    if (isConnected()) {
        echo "<script type='text/JavaScript'>
            alert('Vous ne pouvez pas aller sur cette page en étant connecté !');
            location.replace('$page'); 
        </script>
        ";
        exit();
    }
}

function isNotConnectedRedirect($page = "login.php") {
    /**
     * Fonction de bidouillage pour corriger le warning : Cannot modify header information - headers already sent by
     * 
     * Permet de rediriger l'utilisateur non connecté sur une autre page passé en paramètre après que le headers soit créé.
     * 
    */
    if (!isConnected()) {
        echo "<script type='text/JavaScript'>
        alert('Vous ne pouvez pas aller sur cette page en étant déconnecté !');
        location.replace('$page'); 
        </script>
        ";
        exit();
        }
}

function mysqlConnect() {
    $database_host = 'localhost';
    $database_port = '3306';
    $database_dbname = 'tp_note';
    $database_user = 'root';
    $database_password = '';
    $database_charset = 'UTF8';
    $database_options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    
    $bdd = new PDO(
        'mysql:host=' . $database_host .
        ';port=' . $database_port .
        ';dbname=' . $database_dbname .
        ';charset=' . $database_charset,
        $database_user,
        $database_password,
        $database_options
    );
    return $bdd;
}
?>
