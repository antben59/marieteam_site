<?php
session_start();
require_once('db_connect.php')
?>
   <!-- header -->
    <!doctype html>
<html lang="fr">
  <head>
    <title>MarieTeam</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=K2D:400,700|Niramit:300,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">


    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Sweet Alert -->
  </head>
  <body>

    <header role="banner">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand position-absolute" href="index.php">MarieTeam</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse position-relative" id="navbarsExample05">
            <ul class="navbar-nav mx-auto pl-lg-5 pl-0 d-flex align-items-center">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="liaisons.php">Liaisons</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <?php
                if(isset($_SESSION['id_utilisateur'])){
                  ?>
                 <li class="nav-item">
                <a class="nav-link" href="mes-reservations.php">Mes réservations</a>
              </li>
              <?php if($_SESSION['grade_utilisateur'] == 1){
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="admin/index.php">Administration</a>
                </li>
                <?php

              } ?>
              <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
              </li>
              <?php }else{ ?>
              <li class="nav-item">
                <a class="nav-link" href="connexion_inscription.php">Connexion / Inscription</a>
              </li>
              <?php } ?>


            </ul>
          </div>
        </div>
      </nav>
    </header>
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

    <section class="section">
    <div class="container">
          <div class="col-md-12">
          <h5>Choisir les informations relatives à la liaison</h5>
            <form action="#" method="post">
              <div class="row">

                <div class="col-md-4 form-group">
                  <label for="secteur">Secteur</label>
                  <select class="form-control linked-select" id="country" name="secteur" required>
                    <option value="0"; ?>Séléctionnez votre secteur</option>
                  </select>
                </div>

                <div class="col-md-4 form-group">
                  <label for="liaison">Liaison</label>
                  <select class="form-control" id="state" name="liaison">
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
      </div>
    </section>

<section>
<div class="container">
<div class="col-md-12">
<?php if(isset($_POST['afficher'])){
  $secteur = $_POST['secteur'];
  $liaison = $_POST['liaison'];
  $date = $_POST['date'];
  $dateFormat = date('d/m/Y', strtotime($date));
  $nomSecteur = get_bdd()->query("SELECT nom FROM secteur WHERE id_secteur='$secteur'")->fetch();
  $NomLiaison = get_bdd()->query("SELECT nom FROM liaison WHERE code_liaison='$liaison'")->fetch();
  ?>
  <p style="font-size: 20px;text-align:center;">Vous avez choisi la liason : <span style="font-weight:bold;"><?php echo $NomLiaison['nom']; ?></span>, du secteur : <span style="font-weight:bold;"><?php echo $nomSecteur['nom'] ; ?></span>  pour la date du : <span style="font-weight:bold;"><?php echo $dateFormat; ?></span>.</p>
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
                      $NomBateau = get_bdd()->query("SELECT nom FROM bateau INNER JOIN traversee ON bateau.id_bateau = traversee.id_bateau")->fetch();
                      echo $NomBateau['nom'];
                    ?>
                    </td>
                    <?php
                    $a = $donnees['id_bateau'];
                    $capaciteMaxA = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$a && lettre_categorie='A'")->fetch();
                    $capaciteMaxB = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$a && lettre_categorie='B'")->fetch();
                    $capaciteMaxC = get_bdd()->query("SELECT capaciteMax FROM contenir WHERE id_bateau=$a && lettre_categorie='C'")->fetch();
                    ?>
                    <td style="text-align:center;"><?php echo $capaciteMaxA['capaciteMax']; ?></td>
                    <td style="text-align:center;"><?php echo $capaciteMaxB['capaciteMax']; ?></td>
                    <td style="text-align:center;"><?php echo $capaciteMaxC['capaciteMax']; ?></td>
                    <?php
                    if (!empty($_SESSION['id_utilisateur'])){
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
                if (empty($_SESSION['id_utilisateur'])) {
                  ?>
                  <p style="font-size: 20px;text-align:center;">Pour réserver une traversée vous devez être inscrit et connecter.</p>

                  <?php
                }else{?> 
                  <div class="text-center">
                    <input type="submit" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary" name="envoyer" value="Réserver cette traversée"></input>
                  </div><?php
                }
                ?>

                  </form>
<?php
}
} ?>

</div>
</div>
</section>
    <!-- footer -->
    <?php include('PhpTools/footer.php');?>
    <!-- footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>


<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id){
  		$.ajax({
  			url : "liaison_secteur.php",
  			type : "POST",
  			data: {type : type, id : category_id},
  			success : function(data){
  				if(type == "stateData"){
  					$("#state").html(data);
  				}else{
  					$("#country").append(data);
  				}
  				
  			}
  		});
  	}

  	loadData();

  	$("#country").on("change",function(){
  		var country = $("#country").val();

  		if(country != ""){
  			loadData("stateData", country);
  		}else{
  			$("#state").html("");
  		}

  		
  	})
  });
</script>

  </body>
</html>