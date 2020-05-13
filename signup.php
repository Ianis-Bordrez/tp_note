<?php

require_once('script/main_function.php');

if (!isConnected()) {
    header('Location: login.php');
    exit;
}
?>

<form action="script/s_signup.php" method="post">
    <input type="text" name="userName" placeholder="Nom d'utilisateur">
    <input type="password" name="password" placeholder="Mot de passe">
    <input type="text" name="name" placeholder="Nom">
    <input type="text" name="firstName" placeholder="Pr'enom">
    <input type="text" name="email" placeholder="Email">
    <select name="status">
        <option value="CANDIDAT">Un candidat</option>
        <option value="ENTREPRISE">Une entreprise</option>
        <option value="ADMIN">Un admin</option>
    </select>
    <button type="submit">Envoyer</button>
</form>