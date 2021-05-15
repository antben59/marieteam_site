<?php
session_start();
require_once('db_connect.php'); 
if(isset($_POST['connexion'])){

  $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES);
  $pwd = htmlspecialchars($_POST['mot_de_passe'], ENT_QUOTES);
  $sql = get_bdd()->prepare("SELECT * FROM utilisateurs WHERE mail ='$mail'");
  $sql->execute();
  $n_id = $sql->rowCount();

  if($n_id > 0){

      $get_infos = $sql->fetch();
      $pwd_hash = $get_infos['mot_de_passe'];

          if($pwd == $pwd_hash){
                  $_SESSION['id_utilisateur'] = $get_infos['id'];
                  $_SESSION['grade_utilisateur'] = $get_infos['grade'];
      }

  }
}
  if (isset($_SESSION["id_utilisateur"])) {
    header("Location: mes-reservations.php");
  }


?>
   <!-- header -->
    <!doctype html>
<html lang="fr">
  <head>
    <title>MarieTeam</title>
    <meta charset="utf-8">
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
        <div class="row">
          <div class="col-md-6">
          <h1>Inscription</h1>
            <form action="connexion_inscription.php" method="post">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="nom">Nom</label>
                  <input type="text" class="form-control form-control-lg" id="nom" name="nom" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="prenom">Prénom</label>
                  <input type="text" class="form-control form-control-lg" id="prenom" name="prenom" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg" name="mail" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="nom">Mot de passe</label>
                  <input type="password" class="form-control form-control-lg" id="nom" name="mot_de_passe" required>
                </div>
              </div>
              <div class="row">
              <div class="col-md-12 form-group">
                  <label for="adresse">Adresse</label>
                  <input type="text" class="form-control form-control-lg" id="adresse" name="adresse" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="code_postal">Code Postal</label>
                  <input type="text" class="form-control form-control-lg" id="code_postal" name="code_postal" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="ville">Ville</label>
                  <input type="text" class="form-control form-control-lg" id="ville" name="ville" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <button type="submit" name="inscription" class="btn btn-primary btn-lg btn-block">S'enregistrer</button>
                </div>
              </div>

            </form>
          </div>
          <div class="col-md-6">
          <h1>Connexion</h1>
          <form action="connexion_inscription.php" method="post">
          <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg" name="mail" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Mot de passe</label>
                  <input type="password" id="email" class="form-control form-control-lg" name="mot_de_passe" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                <button type="submit" name="connexion"class="btn btn-primary btn-lg btn-block">Connexion</button>

                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- footer -->
    <?php include('footer.php');?>
    <!-- footer -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>





<?php
if(isset($_POST['inscription'])){
  if(
      !empty($_POST['nom'])
      && !empty($_POST['prenom'])
      && !empty($_POST['mail'])
      && !empty($_POST['mot_de_passe'])
      && !empty($_POST['adresse'])
      && !empty($_POST['code_postal'])
      && !empty($_POST['ville'])
  ){
      $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES);
      $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
      $adresse = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
      $code_postal = htmlspecialchars($_POST['code_postal'], ENT_QUOTES);
      $ville = htmlspecialchars($_POST['ville'], ENT_QUOTES);
      $mail = htmlspecialchars(strtolower($_POST['mail']), ENT_QUOTES);
      $mot_de_passe = htmlspecialchars($_POST['mot_de_passe'], ENT_QUOTES);



              try{
                  $sql = "INSERT INTO utilisateurs(
                      id,
                      nom,
                      prenom,
                      mail,
                      mot_de_passe,
                      adresse,
                      code_postal,
                      ville,
                      grade
                      )
                      values (
                        null,
                      '$nom',
                      '$prenom',
                      '$mail',
                      '$mot_de_passe',
                      '$adresse',
                      '$code_postal',
                      '$ville',
                      '0'
                      )";

                  $req = get_bdd()->prepare($sql);
                  $req->execute();


                }
                catch (Exception $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }

            }

        }



?>