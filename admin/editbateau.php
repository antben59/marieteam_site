<?php
session_start();

if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == true){

        include('headervirgin.php');
        include('bddTools.php');

        if(isset($_GET['type']) && $_GET['type'] == 'editbateau' && isset($_GET['id'])){
            $id_bateau = (int) $_GET['id'];

            // Edit des secteurs en BDD
            if(isset($_POST['form_edit_bateau'])){
                $new_name = $_POST['nom_bateau'];
                try{
                    $sql = $dbco->prepare('UPDATE bateau SET nom = ? WHERE id_bateau = ? ');
                    $sql->execute(array($new_name, $id_bateau));
                    }
                    catch(PDOException $e){
                    echo "Erreur : " . $e->getMessage();
                }
            }
            // END Edit des secteurs en BDD

            // Recuperateur du secteur à modifier

            $sql = $dbco->prepare('SELECT nom FROM bateau WHERE id_bateau = ?');
            $sql->execute(array($id_bateau));
            $bateau = $sql->fetch();
            
            // END Recuperateur du secteur à modifier
        
            // Ajout du Modal HTML : edit
            ?>
            <a class="btn btn-default" href="administration.php" role="button">Retour</a>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Modifier le nom du bateau : <?=$bateau['nom'];?></button>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification de : <?=$bateau['nom'];?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                <form action="editbateau.php?type=editbateau&id=<?=$id_bateau?>" method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nouveau nom :</label>
                        <input type="text" placeholder ="<?=$bateau['nom'];?>" name="nom_bateau" class="form-control" id="nom_bateau">
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" name ="form_edit_bateau" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
            </div>
            </div>

        <?php // END Ajout du Modal HTML : edit

            include('footer.php');
        }
        else{
            header('Location: error404.php');
        }
    }
    else{
        header('Location: error404.php');
    }
}
else{
    header('Location: error404.php');
}