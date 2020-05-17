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
    if ($account) {
        $pid = $account['account_id'];
        $userName = $account['username'];
        $firstName = $account['firstname'];
        $name = $account['name'];
        $description = $account['description'];
        $job = $account['job'];
        $email = $account['email'];
        $phone = $account['phone'];
        $create_date = $account['create_date'];
        if ($account['status'] == 'ENTREPRISE')
            echo "
            <div class='row'>
                <div class='col s4 offset-s2'>";
        else {
            echo "
            <div class='row'>
                <div class='col s4 offset-s4'>";
        }
        echo "
                <div class='card blue-grey darken-1'>
                    <div class='card-content white-text'>
                        <span class='card-title'>Profil</span>
                        <blockquote>Nom d'utilisateur : $userName</blockquote>
                        <blockquote>Prénom : $firstName</blockquote>
                        <blockquote>Nom : $name</blockquote>
                        <blockquote>Déscirption : $description</blockquote>
                        <blockquote>Travail : $job</blockquote>
                        <blockquote>Email : $email</blockquote>
                        <blockquote>Numéro de téléphone : $phone</blockquote>
                        <blockquote>Date de création du compte : $create_date</blockquote>
                        ";
                        
                        $folder = strtolower($firstName."_".$name);
                        $destination = "cv/$folder/cv.pdf";
                        

                        if(file_exists($destination)){
                        echo "
                            <form action='script/show_cv.php' method='post' >
                            <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Voir le CV</button>
                            </form>
                        ";
                        } else {
                            echo"
                                <blockquote>Aucun CV</blockquote>
                            ";
                        }
                        
                        echo "
                        <form action='edit_profile.php' method='post'>
                            <button class='btn waves-effect waves-light' type='submit' name='pid' value='$pid'>Modifier</button>
                        </form>
                        ";
                        echo "
                    </div>
                </div>
            </div>
        ";

        if ($account['status'] == 'ENTREPRISE') {
            $req2 = $bdd->prepare('SELECT * FROM company where boss_id=:id');
            $req2->execute(array("id"=> $pid));
            $comp_info = $req2->fetch();

            if ($comp_info){
                $cid = $comp_info['company_id'];
                $comp_name = $comp_info['name'];
                $comp_desc = $comp_info['description'];
                $comp_memb = $comp_info['member'];
                $comp_activity = $comp_info['activity_area'];

        echo "
            <div class='col s4'>
                <div class='card blue-grey darken-1'>
                    <div class='card-content white-text'>
                        <span class='card-title'>Entreprise</span>
                        <blockquote>Nom : $comp_name</blockquote>
                        <blockquote>Description : $comp_desc</blockquote>
                        <blockquote>Nombre de membre : $comp_memb</blockquote>
                        <blockquote>Domaine d'activité : $comp_activity</blockquote>
                    <form action='edit_company.php' method='post'>
                        <button class='btn waves-effect waves-light' type='submit' name='cid' value='$cid'>Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        ";
            } else {
        echo "
            <div class='col s4'>
                <div class='card blue-grey darken-1'>
                    <div class='card-content white-text'>
                        <span class='card-title'>Aucune entreprise</span>
                    <form action='company.php' method='post'>
                        <button class='btn waves-effect waves-light' type='submit' name='cid' value='$cid'>Créer</button>
                    </form>
                </div>
            </div>
        </div>
        ";
    } 
        }
    } else {
        echo "Utilisateur inexistant";
    }
}
include_once("footer.php");
?>