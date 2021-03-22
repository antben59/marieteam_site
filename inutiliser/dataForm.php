<?php include('fonction.php');

if(isset($_POST['sendregister'])){ // Form de register 
   
    $firstname = noEmpty($_POST['firstname']);
    $email = noEmpty($_POST['email']);
    $mdp = noEmpty($_POST['mdp']);
    $name = noEmpty($_POST['name']);

    if(noEmpty($mdp) == true){ // Cryptage si mdp rempli
        $mdp = cryptToHASH($mdp);
    }

    $tableRegister = array($firstname, $name, $email, $mdp); // liste contenants les infos

    $isError = false;
    foreach ($tableRegister as $value){ // test des variables
        if($value == false){
            $isError = true;
        }
    }
    // Redirection sur la page dataForm
    if($isError == true){
        echo "Champs vide détectés";
    }
    else{
        echo "Compte créé";
    }

}

?>