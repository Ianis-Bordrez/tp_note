<?php
include_once("header.php");

isNotConnectedRedirect();

if ($_SESSION['status'] != 'ADMIN') {
    ?><script> location.replace("index.php"); </script>
    <?php
    exit();
}

$bdd = mysqlConnect();

$req = $bdd->prepare('SELECT * FROM account WHERE account_id != :id');
$req->execute(array('id'=> $_SESSION['account_id']));
$accounts = $req->fetchall();
foreach($accounts as $account) {
    $pid = $account['account_id'];
    $userName = $account['username'];
    $firstName = $account['firstname'];
    $name = $account['name'];
    echo "
        <div>
            <div>
                <h2>$userName</h2>
                <h2>$firstName</h2>
                <h2>$name</h2>
            </div>
    ";

    if ($account['status'] == 'ENTREPRISE') {
        $req2 = $bdd->prepare('SELECT * FROM company where boss_id=:id');
        $req2->execute(array("id"=>$_SESSION['account_id']));
        $comp_info = $req2->fetch();

        if ($comp_info){
            $cid = $comp_info['company_id'];
            $comp_name = $comp_info['name'];
            echo "
                <div>
                    <h2>$comp_name</h2>
                </div>
                <div>
                    <form action='edit_profile.php' method='post'>
                        <button type='submit' name='pid' value='$pid'>Modifier</button>
                    </form>
                    <form action='edit_company.php' method='post'>
                        <button type='submit' name='cid' value='$cid'>Modifier</button>
                    </form>
                </div>
            </div>
            ";
        } else {
            echo "
            <div>
            <form action='edit_profile.php' method='post'>
                <button type='submit' name='pid' value='$pid'>Modifier</button>
            </form>            
            </div>
        </div>";
        }
    } else {
        echo "
            <div>
                <form action='edit_profile.php' method='post'>
                    <button type='submit' name='pid' value='$pid'>Modifier</button>
                </form>
            </div>
        </div>";
    }
}

include_once("footer.php");
?>