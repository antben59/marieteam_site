<?php
session_start();
require_once('db_connect.php');
include('header.php');
?>
<!-- Affichage d'un slider avec du texte -->
    <section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('img/slider-1.jpg');">
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Envie d'une traversée ?</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Formulaire pour afficher les liaisons -->
    <section class="section">
      <div class="container">
        <div class="col-md-12">
          <h5>Choisir les informations relatives à la liaison</h5>
          <form action="#" method="post">
            <div class="row">
              <div class="col-md-4 form-group">
                <label for="secteur">Secteur</label>
                <select class="form-control linked-select" id="secteur" name="secteur" required>
                  <option value="0"; ?>Séléctionnez votre secteur</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="liaison">Liaison</label>
                <select class="form-control" id="liaison" name="liaison">
                  <option value="0"; ?>Séléctionnez votre liaison</option>
                </select>
              </div>
              <div class="col-md-4 form-group">
                <label for="date">Date</label>
                <input class="form-control" type="date" id="date" name="date" required>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-4 form-group">
                <button type="submit" style="margin:30px;" class="btn btn-primary btn-md btn-block" name="afficher">Afficher les traversées</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

<!-- Affichage des liaisons -->
    <section>
      <div class="container">
        <div class="col-md-12">
          <?php 
            if(isset($_POST['afficher'])){
              
              // On récupère les informations du formulaire
              $secteur = $_POST['secteur'];
              $liaison = $_POST['liaison'];
              $date = $_POST['date'];
              $dateFormat = date('d/m/Y', strtotime($date));
              
              // On va récupérer les noms du secteur et de la liaison
              $nomSecteur = get_bdd()->query("SELECT nom FROM secteur WHERE id_secteur='$secteur'")->fetch();
              $NomLiaison = get_bdd()->query("SELECT nom FROM liaison WHERE code_liaison='$liaison'")->fetch();
              ?>
              
              <!-- On affiche le choix du secteur, de la liaison et de la date -->
              <p style="font-size: 20px;text-align:center;">Vous avez choisi la liason : <span style="font-weight:bold;"><?php echo $NomLiaison['nom']; ?></span>, du secteur : <span style="font-weight:bold;"><?php echo $nomSecteur['nom'] ; ?></span>  pour la date du : <span style="font-weight:bold;"><?php echo $dateFormat; ?></span>.</p>
              
              <!-- On va vérifié si il existe une traversee prévu pour la liaison et la date choisi -->
              <!-- Si il en existe pas un message apparaît sinon il affiche les traversées dans un tableau-->
              <?php
                $nbOccurrence = get_bdd()->query("SELECT count(*) FROM traversee where code_liaison='$liaison' && date='$date'")->fetch();
                if($nbOccurrence['0'] == 0){
              ?>
                <p style="font-size: 20px;text-align:center;">Aucune traversée n'est prévu</p>
              <?php
                }else{
              ?>
                <p style="font-size: 20px;text-align:center;">La liste des traversées disponibles :</p>
                <table class="table table-bordered" style="margin-top:20px;">
                  <thead>
                    <tr>
                      <th colspan=3 style="text-align:center;">Traversée</th>
                      <th colspan=3 style="text-align:center;">Places disponibles par catégorie</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="text-align:center;">N°</td>
                      <td style="text-align:center;">Heure</td>
                      <td style="text-align:center;">Bateau</td>
                      <td style="text-align:center;">A Passager</td>
                      <td style="text-align:center;">B Véh.inf.2m</td>
                      <td style="text-align:center;">B Véh.sup.2m</td>
                    </tr>
                  <form action="reservation.php" method="POST">
                    <?php
                      $req = get_bdd()->query("SELECT * FROM traversee where code_liaison='$liaison' && date='$date'");
                      while ($donnees = $req->fetch()){
                    ?>
                      <tr>
                        <td style="text-align:center;"><?php echo $donnees['num_traversee']; ?></td>
                        <td style="text-align:center;"><?php echo substr($donnees['heure'], 0, -3); ?></td>
                        <td style="text-align:center;">
                          <?php
                            $num_traversee = $donnees['num_traversee'];
                            $NomBateau = get_bdd()->query('SELECT nom FROM bateau INNER JOIN traversee ON bateau.id_bateau = traversee.id_bateau WHERE num_traversee="'.$num_traversee.'"')->fetch();
                            echo $NomBateau['nom'];
                          ?>
                        </td>
                          <?php
                            $idBateau = $donnees['id_bateau'];
                            $capaciteMaxA = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$idBateau AND lettre_categorie='A'")->fetch();
                            $capaciteMaxB = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$idBateau AND lettre_categorie='B'")->fetch();
                            $capaciteMaxC = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$idBateau AND lettre_categorie='C'")->fetch();
    
                            $placeReserveA = get_bdd()->query('SELECT SUM(quantiteAdulte+quantiteJunior+quantiteEnfant) FROM reservation WHERE num_traversee="'.$num_traversee.'"')->fetch();
                            $placeReserveB = get_bdd()->query('SELECT SUM(quantiteVoitureInf4m+quantiteVoitureInf5m) FROM reservation WHERE num_traversee="'.$num_traversee.'"')->fetch();
                            $placeReserveC = get_bdd()->query('SELECT SUM(quantiteFourgon+quantiteCampingCar+quantiteCamion) FROM reservation WHERE num_traversee="'.$num_traversee.'"')->fetch();
                          ?>
                        <td style="text-align:center;"><?php echo ($capaciteMaxA['capaciteMax']-$placeReserveA[0]); ?></td>
                        <td style="text-align:center;"><?php echo ($capaciteMaxB['capaciteMax']-$placeReserveB[0]); ?></td>
                        <td style="text-align:center;"><?php echo ($capaciteMaxC['capaciteMax']-$placeReserveC[0]); ?></td>
                          <?php
                            //Si la variable de session existe on affiche les boutons radio qui permettent de sélectionner une traversée
                            if(!empty($_SESSION['id_utilisateur'])){
                          ?>
                        <td style="text-align:center;"><input type="radio" value="<?php echo $NomLiaison['nom'].";".$donnees['num_traversee'].";".$dateFormat.";". substr($donnees['heure'], 0, -3).";".$date; ?>" name="choix"></td>
                          <?php
                            }
                          ?>
                      </tr>
                    <?php
                      }
                      ?>
                    </tbody>
                    </table>
                    <?php
                      //Si la variable de session n'existe pas on affiche un message à la place du bouton réserver
                      if (empty($_SESSION['id_utilisateur'])) {
                        ?>
                          <p style="font-size: 20px;text-align:center;">Pour réserver une traversée vous devez être inscrit et connecter.</p>
                        <?php
                          }else{
                        ?> 
                          <div class="text-center">
                            <input type="submit" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary" name="envoyer" value="Réserver cette traversée"></input>
                          </div>
                        <?php
                          }
                        ?>
                  </form>
              <?php
              }
            }
          ?>

        </div>
      </div>
    </section>
<!-- footer -->
  <?php include('footer.php');?>
<!-- footer -->

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/main.js"></script>

<!-- On charge les secteurs et les liaisons dans les select du formulaire -->
  <script type="text/javascript">
    $(document).ready(function(){
      function loadData(type, category_id){
        $.ajax({
          url : "liaison_secteur.php",
          type : "POST",
          data: {type : type, id : category_id},
          success : function(data){
            if(type == "liaisonData"){
              $("#liaison").html(data);
            }else{
              $("#secteur").append(data);
            }
            
          }
        });
      }

      loadData();
      $("#secteur").on("change",function(){
        var secteur = $("#secteur").val();

        if(secteur != ""){
          loadData("liaisonData", secteur);
        }else{
          $("#liaison").html("");
        }

        
      })
    });
  </script>

  </body>
</html>