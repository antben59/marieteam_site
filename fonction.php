<?php 

function  parseVerif($var){ // return var parser, securité contre injection sql
    return htmlspecialchars($var, ENT_QUOTES);
}

function noEmpty($var){ // return var parsé si pas vide, sinon return false
    if(!empty($var)){
        return parseVerif($var);
    }
    else{
        return false;
    }
}

function cryptToSHA1($var){ // Hashage uniquement dans 1 sens lol
    return sha1($var);
}

function cryptToHASH($var){
    $options = [
        'cost' => 15,
    ];
    return password_hash($var, PASSWORD_BCRYPT, $options);
}

function verifyHASH($mdpHash, $mdp){ // Verifie entre le hash et le mdp, return true si correspond

    if(password_verify($mdp, $mdpHash)){
        return true;
    }
    else return false;
}

function getJsonElement($chemin, $nameTab, $element){
    $data = file_get_contents($chemin); 
    // décoder le flux JSON
    $obj = json_decode($data); 
    // accéder à l'élément approprié
    return $obj->{$nameTab}[0]->{$element};

    // ex : echo getJsonElement("../log.json", "BDDlog", "mdp");
}

/*
function giveAlertForAccount(){

    if(isset($_GET['account'])) {  // Si presence de account dans URL après ? 
        if($_GET['account'] =="sucess"){ // Si account = sucess alors on affiche la popup
            include("popup/PopupAccountcreated.php");

        }
        else if($_GET['account'] =="echec"){
            include("popup/PupupAccountNotCreated.php");
        }
    }
}
*/

function AffichePopup($icon, $title, $text, $footer){ // sucess ou error
         if($icon == "success"){
    ?>
        <script>
            Swal.fire({
            position: 'center',
            icon: '<?=$icon?>',
            title: '<?=$title?>',
            })
        </script>
    <?php
}else{
?>
        <script>
        Swal.fire({
        position: 'center',
        icon: '<?=$icon?>',
        title: '<?=$title?>',
        text: '<?=$text?>',
        footer: '<?=$footer?>',
        })
        </script>
<?php  }
}


function GetId($name){
    $name1 = explode('.', $name);
    return $name1[0];
}

function GetNomPort($id_port){

    $servname = getJsonElement('../log.json','BDDlog','serveurname');
    $dbname = getJsonElement('../log.json','BDDlog','dbname');
    $user = getJsonElement('../log.json','BDDlog','login');
    $pass = getJsonElement('../log.json','BDDlog','mdp');
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

    
    $sql = $dbco->prepare('SELECT nom FROM port WHERE id_port = ?');
    $sql->execute(array($id_port));
    $port = $sql->fetch();

    return $port['nom'];
    
}

function GetNomBateau($id_bateau){

    $servname = getJsonElement('../log.json','BDDlog','serveurname');
    $dbname = getJsonElement('../log.json','BDDlog','dbname');
    $user = getJsonElement('../log.json','BDDlog','login');
    $pass = getJsonElement('../log.json','BDDlog','mdp');
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

    
    $sql = $dbco->prepare('SELECT nom FROM bateau WHERE id_bateau = ?');
    $sql->execute(array($id_bateau));
    $bateau = $sql->fetch();

    return $bateau['nom'];
    
}
/*
function GetArraylistLiaisonsPourUnSecteur($id_secteur){
    $tab = array();
    $servname = getJsonElement('../../log.json','BDDlog','serveurname');
    $dbname = getJsonElement('../../log.json','BDDlog','dbname');
    $user = getJsonElement('../../log.json','BDDlog','login');
    $pass = getJsonElement('../../log.json','BDDlog','mdp');
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

    $reponse = $dbco->query("SELECT * FROM liaison WHERE id_secteur ='$id_secteur' ");
    while ($data = $reponse->fetch()){
        $tab.array_push(GetNomPort($data['id_port']) + '=>' + GetNomPort($data['id_port_ARRIVEE']));
    }
    return $tab;
}
*/

// Obtiens dans un tableau le couple port/port_ARRIVEE de toutes les liaisons au sein du même secteur
function GetTableauLiaisonsDuSecteur($secteur){ 

    $tableau_liaisons = [];

    $servname = getJsonElement('../log.json','BDDlog','serveurname');
    $dbname = getJsonElement('../log.json','BDDlog','dbname');
    $user = getJsonElement('../log.json','BDDlog','login');
    $pass = getJsonElement('../log.json','BDDlog','mdp');
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);

    $sql = $dbco->prepare('SELECT * FROM secteur WHERE nom = ?');
    $sql->execute(array($secteur));
    $secteur = $sql->fetch();

    $id_secteur = $secteur['id_secteur'];

    $reponse = $dbco->query("SELECT * FROM liaison WHERE id_secteur='$id_secteur'");

    while ($dataliaisons = $reponse->fetch()){
        $var = GetNomPort($dataliaisons['id_port']).' => '.GetNomPort($dataliaisons['id_port_ARRIVEE']);
        array_push($tableau_liaisons,$var);
    }
    return $tableau_liaisons;
}

