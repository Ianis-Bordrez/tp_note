<?php
include_once("header.php");

isNotConnectedRedirect();

$rid = null;

if (isset($_POST['oid'])){
    $oid = $_POST['oid'];
}
elseif (isset($_POST['rid'])){
    $rid = $_POST['rid'];
} else{
    ?><script> location.replace("index.php"); </script>
    <?php
    // header('Location: index.php');
    exit();
}

$bdd = mysqlConnect();

if ($rid) {
    $req2 = $bdd->prepare('SELECT * FROM offer_answer WHERE answ_id=:rid');
    $req2->execute(array('rid' => $rid));
    $answ_info = $req2->fetch();
    $oid = $answ_info['offer_id'];
    $answ_owner_id = $answ_info['account_id'];
}

$req = $bdd->prepare('SELECT * FROM offer WHERE offer_id=:oid');
$req->execute(array('oid' => $oid));
$offer_info = $req->fetch();



$title = $offer_info['title'];
$content = $offer_info['content'];
$offer_date = $offer_info['offer_date'];
echo "
    <div class='row'>
        <div class='col s12 m6'>
            <div class='card blue-grey darken-1'>
                <div class='card-content white-text'>
                    <span class='card-title'>$title</span>
                    <blockquote>$content</blockquote>
                    <p>$offer_date</p>";

                    if ($rid) {
                        if ($answ_info){
                            $answ_text = $answ_info['answer'];
                            $answ_date = $answ_info['answer_date'];
                            $req3 = $bdd->prepare('SELECT account_id,username FROM account WHERE account_id=:answ_owner_id');
                            $req3->execute(array('answ_owner_id'=> $answ_owner_id));
                            $answ_owner_info = $req3->fetch();
                            $answ_owner_username = $answ_owner_info['username'];
                            echo "
                            <div class = 'card-panel blue-grey'>
                                <p>Réponse de $answ_owner_username<p>
                                <blockquote class='blue-grey'>$answ_text</blockquote>
                                <p>$answ_date</p>
                            </div>
                            ";
                        }
                    }
                echo "
                </div>
            </div>
        </div>
    </div>
    ";

if ($rid){
    echo "
    <div class='row center'>
    <div class='col s6 offset-s3'>
        <div class='card blue-grey darken-1'>
            <span class='card-title'>Votre réponse</span>
            <div class='card-action'>
                <form action='script/s_answ_offer.php' method='post'>
                <div class='row'>
                    <textarea placeholder='Votre réponse' name='answer' type='text'></textarea>
                </div class='row'>
                <div class='row'>
                    <div class='col s11'>
                        Type de réponse :
                        <div class='input-field inline'>
                            <p>
                                <label>
                                    <input name='yes_or_no' value='1' type='radio' />
                                    <span>Favorable</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name='yes_or_no' value='0' type='radio' />
                                    <span>Défavorable</span>
                                </label>
                            </p>
                        </div>
                    </div> 
                </div class='row'>
                    <button class='btn waves-effect waves-light' type='submit' name='rid' value='$rid'>Répondre</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    ";

} else {
    echo "
    <div class='row center'>
        <div class='col s4 offset-s4'>
            <div class='card blue-grey darken-1'>
                <span class='card-title'>Votre réponse</span>
                <div class='card-action'>
                    <form action='script/s_answ_offer.php' method='post'>
                        <div class='input-field'>
                            <textarea id='answer' name='answer' class='materialize-textarea'></textarea>
                            <label for='answer'>Entrez votre réponse à l'offre</label>
                        </div>
                        <button class='btn waves-effect waves-light' type='submit' name='oid' value='$oid'>Répondre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    ";

}


include_once("footer.php");
?>