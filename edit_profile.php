<?php
require_once('script/main_function.php');

if (!isConnected()) {
    header('Location: login.php');
    exit;
}

$pid = $_GET['pid'];

if(!isset($pid)) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <body>

    <?php
    $bdd = mysqlConnect();

    $req1 = $bdd->prepare('SELECT * FROM account WHERE account_id=:pid');
    $req1->execute(array(
        'pid' => $pid
    ));
    $resultat = $req1->fetch();

    $id = $resultat['account_id'];
    $userName = $resultat['username'];
    // $password = $resultat[''];
    $firstName = $resultat['firstname'];
    $name = $resultat['name'];
    $email = $resultat['email'];
    $phone = $resultat['phone'];
    // $hire_date = $resultat['hire_date'];
    // $status = $resultat['status'];

        echo "<form action='script/s_edit_profile.php?pid=$pid' method='post'>";
        echo "<input placeholder='Prénom' name='firstName' type='text' value='$firstName'><br>";
        echo "<input placeholder='Nom' name='name' type='text' value='$name'><br>";
        echo "<input placeholder='Email' name='email' type='text' value='$email'><br>";
        echo "<input placeholder='Téléphone' name='phone' type='text' value='$phone'><br>";
    ?>
            <input name="submit" type="submit" value="Modifier">
        </form>    
    </body>
</html>