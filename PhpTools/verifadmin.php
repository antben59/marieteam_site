<!-- Fonction -->
<?php
session_start();
include('fonction.php');
include('bddTools.php');

?>
<!-- END Fonction -->
<?php

if(isset($_POST['sended'])){ // Form de admin 
    $login = noEmpty($_POST['login']);
    $mdp = noEmpty($_POST['mdp']);

    $loginSERVEUR = getJsonElement("../log.json", "adminPanel", "login");
    $mdpSERVER =  getJsonElement("../log.json", "adminPanel", "mdp");

    if($login == $loginSERVEUR && $mdp == $mdpSERVER){
        $_SESSION['admin'] = true;
        header('Location: administration.php');
    }
    else{
        $_SESSION['admin'] = false;
        header('Location: ../admin.php');
    }
}
else{
    header('Location: error404.php');
}

?>