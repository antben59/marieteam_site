<?php
session_start();

if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == true){
        include('headervirgin.php');
        include('fonction.php');
        require 'bddTools.php'; 
    
        // Ajout du Modal HTML : créer secteur
        ?><hr>
        <center> 
        <h1>MY DASHBOARD</h1>
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Ajouter un secteur</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#port">Ajouter un port</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bateau">Ajouter un bateau</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categorie">Ajouter une catégorie</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#traversee">Ajouter une traversée</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periode">Ajouter une période</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#type">Ajouter un type d'enregistrement</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tarif">Ajouter une tarification</button>
        <hr>

      </center><br>

      <div class="modal fade" id="type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'un type d'enregistrement</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Libelle Type:</label>
                  <input type="text" name="libelle_type" class="form-control" id="libelle_type">

                  <label for="recipient-name" class="col-form-label">Lettre catégorie :</label>

                  <select class="custom-select" id="lettre_categorie" name="lettre_categorie">

                  <?php $reponse = $dbco->query('SELECT * FROM categorie');
                      while ($data = $reponse->fetch()){ ?>  

                      <option selected><?=$data['lettre_categorie']?></option>

                  <?php }?>

                  </select>

                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="type_form" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>


      <div class="modal fade" id="tarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'une tarification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Date début :</label>

                <select class="custom-select" id="date_debut" name="date_debut">

                <?php $reponse = $dbco->query('SELECT * FROM periode');
                    while ($data = $reponse->fetch()){ ?>  

                    <option selected><?=$data['id']?>.<?=$data['date_debut']?></option>

                <?php }?>

                </select>

                <label for="recipient-name" class="col-form-label">Liaison :</label>

                <select class="custom-select" id="code_liaison" name="code_liaison">

                <?php $reponse = $dbco->query('SELECT * FROM liaison');
                    while ($data = $reponse->fetch()){ ?>  
                    <option selected><?=$data['code_liaison']?>.<?=GetNomPort($data['id_port']);?>=><?=GetNomPort($data['id_port_ARRIVEE']);?></option>

                <?php }?>

                </select>


                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_tarif" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <div class="modal fade" id="periode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'une période</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Date début:</label>
                  <input type="date" name="date_debut" class="form-control" id="date_debut">

                  <label for="recipient-name" class="col-form-label">Date fin:</label>
                  <input type="date" name="date_fin" class="form-control" id="date_fin">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_periode" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <div class="modal fade" id="traversee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'une traversée</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Date de la traversée :</label>
                  <input type="date" name="date_traversee" class="form-control" id="date_traversee">
                  <label for="recipient-name" class="col-form-label">Heure de la traversée :</label>
                  <input type="time" name="time_traversee" class="form-control" id="time_traversee">
                  <label for="recipient-name" class="col-form-label">Bateau:</label>

                  <select class="custom-select" id="id_bateau" name="id_bateau">

                  <?php $reponse = $dbco->query('SELECT * FROM bateau');
                      while ($data = $reponse->fetch()){ ?>  

                      <option selected><?=$data['id_bateau']?>.<?=$data['nom']?></option>

                  <?php }?>

                  </select>
                
                <label for="recipient-name" class="col-form-label">Liaison:</label>

                <select class="custom-select" id="code_liaison" name="code_liaison">

                <?php $reponse = $dbco->query('SELECT * FROM liaison');
                    while ($data = $reponse->fetch()){ ?>  

                    <option selected><?=$data['code_liaison']?>.<?=GetNomPort($data['id_port']);?>=><?=GetNomPort($data['id_port_ARRIVEE']);?></option>

                <?php }?>

                </select>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_traversee" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <div class="modal fade" id="categorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'une nouvelle categorie</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Abréviation categorie:</label>
                  <input type="text" name="abreviation_categorie" class="form-control" id="abreviation_categorie">
                  <label for="recipient-name" class="col-form-label">Nom categorie:</label>
                  <input type="text" name="nom_categorie" class="form-control" id="nom_categorie">
                  <label for="recipient-name" class="col-form-label">Bateau à lier:</label>

                  <select class="custom-select" id="id_bateau" name="id_bateau">
                
                <?php $reponse = $dbco->query('SELECT * FROM bateau');
                      while ($data = $reponse->fetch()){ ?>  

                      <option selected><?=$data['id_bateau']?>.<?=$data['nom']?></option>

                <?php }?>
                  
                  </select>
                  <label for="recipient-name" class="col-form-label">Quantité max :</label>
                  <input type="text" name="quantite_max" class="form-control" id="quantite_max">

                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_categorie" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <div class="modal fade" id="bateau" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'un nouveau bateau</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nom du nouveau bateau:</label>
                  <input type="text" name="nom_bateau" class="form-control" id="nom_bateau">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_bateau" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'un nouveau secteur</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nom du nouveau secteur:</label>
                  <input type="text" name="nom_secteur" class="form-control" id="nom_secteur">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_secteur" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <?php  
       // END Ajout du Modal HTML : créer secteur

        // Ajout du Modal HTML : créer une ville?>

      <div class="modal fade" id="port" tabindex="-1" role="dialog" aria-labelledby="port" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Création d'un port</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <div class="modal-body">
            <form action="administration.php" method="get">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nom du nouveau port:</label>
                  <input type="text" name="nom_port" class="form-control" id="nom_secteur">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" name ="form_port" class="btn btn-primary">Ajouter</button>
              </form>
          </div>
        </div>
      </div>
      </div>

      <?php   // END Ajout du Modal HTML : créer une ville

          // Ajouter une periode //
          if(isset($_GET['form_periode'])){ 
            $date_debut = $_GET['date_debut'];
            $date_fin = $_GET['date_fin'];

            try{
              $sql = "INSERT INTO periode(date_debut, date_fin) VALUES ('$date_debut','$date_fin')"; 
              $dbco->exec($sql);
            }
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
          }
        
      // END Ajout d'une traversée //

          // Ajouter une traversée //
          if(isset($_GET['form_traversee'])){ 
            $date_traversee = $_GET['date_traversee'];
            $heure_traversee = $_GET['time_traversee'];
            $id_bateau = GetId($_GET['id_bateau']);
            $code_liaison = GetId($_GET['code_liaison']);

            try{
              $sql = "INSERT INTO traversee(date, heure, code_liaison, id_bateau) VALUES ('$date_traversee','$heure_traversee','$id_bateau','$code_liaison')"; 
              $dbco->exec($sql);
            }
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
          }
        
      // END Ajout d'une traversée //

          // Ajouter une catégorie //
          if(isset($_GET['form_categorie'])){ 
              $abreviation_categorie = $_GET['abreviation_categorie'];
              $nom_categorie = $_GET['nom_categorie'];
              $id_bateau = GetId($_GET['id_bateau']);
              $quantite_max = $_GET['quantite_max'];

              try{
                $sql = "INSERT INTO categorie(lettre_categorie, nom_categorie, id_bateau, quantite_max) VALUES ('$abreviation_categorie','$nom_categorie','$id_bateau','$quantite_max')"; 
                $dbco->exec($sql);
              }
              catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
              }
            }
          
        // END Ajout d'une catégorie //

        // Ajouter un bateau //
        if(isset($_GET['form_bateau'])){ 
          if(isset($_GET['nom_bateau'])){
              $nom_du_bateau = $_GET['nom_bateau'];

              try{
                $sql = "INSERT INTO bateau(nom) VALUES ('$nom_du_bateau')"; 
                $dbco->exec($sql);
              }
              catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
              }
          }
        }
      // END Ajout d'un bateau //

        // Ajouter un port //
        if(isset($_GET['form_port'])){ 
          if(isset($_GET['nom_port'])){
              $nom_du_port = $_GET['nom_port'];

              try{
                $sql = "INSERT INTO port(nom) VALUES ('$nom_du_port')"; 
                $dbco->exec($sql);
              }
              catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
              }
          }
        }
      // END Ajout d'un port //

        // Ajouter un secteur //
        if(isset($_GET['form_secteur'])){ 
            if(isset($_GET['nom_secteur'])){
                $nom_du_secteur = $_GET['nom_secteur'];

                try{
                  $sql = "INSERT INTO secteur(nom) VALUES ('$nom_du_secteur')"; 
                  $dbco->exec($sql);
                }
                catch(PDOException $e){
                  echo "Erreur : " . $e->getMessage();
                }
            }
          }
        // END Ajout d'un secteur //

        // Suppression des periode
        if(isset($_GET['type']) && $_GET['type'] == 'deleteperiode'){
          try{
            $periode = $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM periode WHERE id = ?');
            $sql->execute(array($periode));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }
        // END Suppression des periode

        // Suppression des traversee
        if(isset($_GET['type']) && $_GET['type'] == 'deletetraversee'){
          try{
            $traversee = $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM traversee WHERE num_traversee = ?');
            $sql->execute(array($traversee));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }
        // END Suppression des traversee

        // Suppression des categories
        if(isset($_GET['type']) && $_GET['type'] == 'deletecategorie'){
          try{
            $categorie = $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM categorie WHERE lettre_categorie = ?');
            $sql->execute(array($categorie));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }
        // END Suppression des categories

        // Suppression des secteurs
        if(isset($_GET['type']) && $_GET['type'] == 'delete'){
          try{
            $id_secteur = (int) $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM secteur WHERE id_secteur = ?');
            $sql->execute(array($id_secteur));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }
        // END Suppression des secteurs

        // Suppression des ports
        if(isset($_GET['type']) && $_GET['type'] == 'deleteport'){
          try{
            $id_port = (int) $_GET['id'];
            $sql = $dbco->prepare('DELETE FROM port WHERE id_port = ?');
            $sql->execute(array($id_port));
          }
          catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
          }
        }
        // END Suppression des ports

          // Suppression des bateaux
          if(isset($_GET['type']) && $_GET['type'] == 'deletebateau'){
            try{
              $id_bateau = (int) $_GET['id'];
              $sql = $dbco->prepare('DELETE FROM bateau WHERE id_bateau = ?');
              $sql->execute(array($id_bateau));
            }
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
          }
          // END Suppression des bateaux
        
        // Ecriture des secteurs
        $reponse = $dbco->query('SELECT * FROM secteur ORDER BY id_secteur DESC');?>
        <div class="row">
        <div class="col-3">
        <div class="list-group" id="list-tab" role="tablist">
        <li class="list-group-item list-group-item-primary"><center><strong>SECTEURS</strong> </center></li><?php

        while ($data = $reponse->fetch()){ ?>
        <a class="list-group-item list-group-item-action" id="list-home-<?=$data['id_secteur']?>" 
        data-toggle="list" href="#list-<?=$data['id_secteur']?>" role="tab" aria-controls="home"><?=$data['nom']?></a>   
        </li><?php  }  ?>    

        </div>
        </div>

        <div class="col-2">      

          <div class="tab-content" id="nav-tabContent">
          <?php 
            $reponse2 = $dbco->query('SELECT * FROM secteur');
            while ($data1 = $reponse2->fetch()){ ?>  

            <div class="tab-pane fade show" id="list-<?=$data1['id_secteur']?>" role="tabpanel" aria-labelledby="list-home-<?=$data1['id_secteur']?>">          
            <button><a href="administration.php?type=delete&id=<?=$data1['id_secteur']?>">Supprimer</a></button>  
            <button><a href="editsecteur.php?type=edit&id=<?=$data1['id_secteur']?>">Modifier</a></button>
            <button><a href="liaisons.php?secteur=<?=$data1['id_secteur']?>">Liaisons</a></button>
            
          </div>
           <?php } ?>
       
      </div></div><?php
        // END Ecriture des secteurs ?>

        <?php // Ecriture des ports ?>
        <div class="col-2">
        <table class="table table-dark">
          <thead>
          <tr>
          <li class="list-group-item list-group-item-primary"><center><strong>PORTS</strong> </center> </li>
        </tr>
          </thead>
          <tbody>
            </div>
        <?php
        $reponse3 = $dbco->query('SELECT * FROM port ORDER BY id_port desc');
          while ($data3 = $reponse3->fetch()){
            ?>

            <tr>
              <td><?=$data3['nom'];?></td>
              <td>
              <button><a href="administration.php?type=deleteport&id=<?=$data3['id_port'] ?>"> ❌</a></button>  
              </td>
              <td>
              <button><a href="editport.php?type=editport&id=<?= $data3['id_port'] ?>">✏️</a></button>
              </td>
            </tr>

          <?php }?>
          </tbody>
          </table>

        </div>
        <br>
        <?php  // Ecriture des ports
      

              // Ecriture des bateaux?>
              <div class="col-2">
              <table class="table table-dark">
                <thead>
                <tr>
                <li class="list-group-item list-group-item-primary"><center><strong>BATEAUX</strong> </center> </li>
              </tr>
                </thead>
                <tbody>
                  </div>
              <?php
              $reponse = $dbco->query('SELECT * FROM bateau ORDER BY id_bateau desc');
                while ($data = $reponse->fetch()){
                  ?>
      
                  <tr>
                    <td><?=$data['nom'];?></td>
                    <td>
                    <button><a href="administration.php?type=deletebateau&id=<?=$data['id_bateau'] ?>"> ❌</a></button>  
                    </td>
                    <td>
                    <button><a href="editbateau.php?type=editbateau&id=<?= $data['id_bateau'] ?>">✏️</a></button>
                    </td>
                  </tr>
      
                <?php }?>
                </tbody>
                </table></div>  <?php
             // END Ecriture des bateaux


             // Ecriture des categories?>
              <div class="col-2">
              <table class="table table-dark">
                <thead>
                <tr>
                <li class="list-group-item list-group-item-primary"><center><strong>CATEGORIES</strong> </center> </li>
              </tr>
                </thead>
                <tbody>
                  </div>
              <?php
              $reponse = $dbco->query('SELECT * FROM categorie');
                while ($data = $reponse->fetch()){
                  ?>
                  <tr>
                    <td><?=$data['lettre_categorie'];?> | <?=$data['nom_categorie'];?> <br>
                    <?=GetNomBateau($data['id_bateau']);?> | <?=$data['quantite_max'];?></td>
                    <td>
                    <button><a href="administration.php?type=deletecategorie&id=<?=$data['lettre_categorie'] ?>"> ❌</a></button>  
                    </td>
                  </tr>
      
                <?php }?>
                </tbody>
                </table><?php
             // END Ecriture des categories

              
             ?> </div>  </div>  </div>  <hr><?php
               // Ecriture des traversées?>

                <table class="table  table-dark">
                <thead>
                  <tr>
                  <li class="list-group-item list-group-item-primary"><center><strong>TRAVERSEES</strong> </center> </li>
                    <th scope="col">num_traversee</th>
                    <th scope="col">date</th>
                    <th scope="col">heure</th>
                    <th scope="col">code_liaison</th>
                    <th scope="col">nom bateau</th>
                    <th scope="col">Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                  $reponse = $dbco->query('SELECT * FROM traversee');
                    while ($data = $reponse->fetch()){
                  ?><tr>
                    <td><?=$data['num_traversee'];?></td>
                    <td><?=$data['date'];?></td>
                    <td><?=$data['heure'];?></td>
                    <td><?=$data['code_liaison'];?></td>
                    <td><?=$data['id_bateau'];?></td>
                    <td> <button><a href="administration.php?type=deletetraversee&id=<?=$data['num_traversee'] ?>"> ❌</a></button>  </td>
                    </tr>
                    <?php }?>
                  
                </tbody>
              </table><?php
             // END Ecriture des traversées
            
            ?>
            </div>  </div>  </div>  <?php
          
            // Ecriture des periode?>

             <table class="table  table-dark">
             <thead>
               <tr>
               <li class="list-group-item list-group-item-primary"><center><strong>PERIODES</strong> </center> </li>
                 <th scope="col">date_debut</th>
                 <th scope="col">date_fin</th>
                 <th scope="col">supprimer</th>
               </tr>
             </thead>
             <tbody>
               
               <?php
               $reponse = $dbco->query('SELECT * FROM periode');
                 while ($data = $reponse->fetch()){
               ?><tr>
                 <td><?=$data['date_debut'];?></td>
                 <td><?=$data['date_fin'];?></td>
                 <td> <button><a href="administration.php?type=deleteperiode&id=<?=$data['id'] ?>"> ❌</a></button>  </td>
                 </tr>
                 <?php }?>
               
             </tbody>
           </table><?php
          // END Ecriture des traversées
         
        

        include('footer.php');
    }
    else{
        header('Location: error404.php');
    }
}
else{
    header('Location: error404.php');
}