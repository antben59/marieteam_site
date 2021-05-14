<?php
session_start();

if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == true){

        include('headervirgin.php');
        include('bddTools.php');
        include('fonction.php');

        // Suppression des liaisons
        if(isset($_GET['type'])&&$_GET['type']=="delete"){
          try{
            $id_liaison = (int) $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM liaison WHERE code_liaison = ?');
            $sql->execute(array($id_liaison));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }

        // END Suppression des liaisons

        if(isset($_GET['secteur'])){
          $id_secteur = (int) $_GET['secteur'];

          $sql = $dbco->prepare('SELECT nom FROM secteur WHERE id_secteur = ?');
          $sql->execute(array($id_secteur));
          $secteur = $sql->fetch();

        ?>
          <center><hr>  <H1> Liaisons de <?=$secteur['nom']?>  </H1>
          <hr>
          <form action="liaisons.php?type=liaisons&secteur=<?=$id_secteur?>" method="post">

          <div class="col-2"> 
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  </div>
                  <select class="custom-select" id="port1" name="port1">

                <?php $reponse = $dbco->query('SELECT * FROM port');
                      while ($data = $reponse->fetch()){ ?>  
          
                        <option selected><?=$data['id_port']?>.<?=$data['nom']?></option>
                 <?php }?>
                    </div>
                  </select>
                </div>
                
                 </div>
                 <div class="col-2">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  </div>
                  <select class="custom-select" id="port2" name="port2">
  
                <?php $reponse = $dbco->query('SELECT * FROM port');
                      while ($data = $reponse->fetch()){ ?>  

                      <option selected><?=$data['id_port']?>.<?=$data['nom']?></option>
          
                <?php }?>
                    </div>
                  </select>
                </div></div>
                <div class="col-2">

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Distance</span>
                </div>
                <input type="text" id="distance" name ="distance" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">km</span>
                </div>
              </div>
                <button type="submit" class="btn btn-primary" name="sended" id="sended">Ajouter la liaison</button><hr>
            </form>


                </center>
                  <?php // Traitement des données & Ecriture des liaisons en BDD

                  if(isset($_POST['sended'])){

                    if(empty($_POST['distance'])){
                      $distance = 0;
                    }
                    else{
                      $distance = $_POST['distance'];
                    }

                    $distance_float = floatval($distance);
                    $port1 = $_POST['port1'];
                    $port2 = $_POST['port2'];

                    if(is_float($distance_float)){
                      
                      if($port1!= $port2){

                        $idport1 = GetId($port1);
                        $idport2 = GetId($port2);

                        $sql = $dbco->prepare('SELECT * FROM liaison WHERE id_secteur = ? AND id_port = ? AND id_port_ARRIVEE = ?');
                        $sql->execute(array($id_secteur, $idport1, $idport2));
                        $nbr_meme_liaisons = $sql->rowCount();

                        if($nbr_meme_liaisons <1){
                          $req = $dbco->prepare('INSERT INTO liaison(distance, id_secteur, id_port, id_port_ARRIVEE) VALUES( :distance, :id_secteur, :id_port, :id_port_ARRIVEE)');
                          $req->execute(array(
                            'distance' => $distance,
                            'id_secteur' => $id_secteur,
                            'id_port' => $idport1,
                            'id_port_ARRIVEE' => $idport2
                            ));
  
                            
                            AffichePopup('sucess','Liaison ajoutée', '', '');
                        }
                        else{
                          AffichePopup('error','Liaison non ajoutée', 'Il y a déjà une liaison existante','');
                        }   
                      }
                      else{
                        AffichePopup('error','Liaison non ajoutée', 'Les ports selectionnés ne peuvent pas être identique','');
                      }
                    }
                    else{
                      AffichePopup('error','Liaison non ajoutée', 'La distance doit être un nombre','');
                    }

                  } // END Traitement des données & Ecriture des liaisons en BD

                  // Ecriture des liaisons ?>
                  <center>
                  <div class="col-3">
                  <table class="table table-dark">
                    <thead>
                    <tr>
                    <th scope="col">Nom port</th>
                    <th scope="col">Nom port arrivé</th>
                    <th scope="col">Distance</th>
                    <th scope="col">Supprimer </th>
                  </tr>
                    </thead>
                    <tbody>
                  <?php

                    $reponse = $dbco->query("SELECT * FROM liaison WHERE id_secteur ='$id_secteur'");
                    while ($data = $reponse->fetch()){
                      ?>
                      <tr>
                        <td><?=GetNomPort($data['id_port']);?></td>
                        <td><?=GetNomPort($data['id_port_ARRIVEE']);?></td>
                        <td><?=$data['distance'];?></td>
                        <td>
                        <button><a href="liaisons.php?type=delete&id=<?=$data['code_liaison']?>&secteur=<?=$id_secteur?>"> Supprimer</a></button>
                        </td>
                     </tr>

          
                    <?php }?>
                    </tbody>
                    </table>
          
                  </div>
                </div>   </div>    <br>
                   
                </center>
                <?php // END Ecriture des liaisons

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