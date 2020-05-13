<?php

session_start();

function isConnected() {
    if (!isset($_SESSION['username'])) {
        return False;
    }
    return True;
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
