<?php
session_start();
require_once('db_connect.php'); 

  if (!isset($_SESSION["id_utilisateur"])) {
    header("Location: index.php");
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
              <li class="nav-item">
                <a class="nav-link" href="/admin/index.php">Administration</a>
              </li>
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
              <h1 class="text-white">Mes réservations</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>dedeed</h1><br>
          <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nom Prénom</th>
            <th scope="col">Prestation</th>
            <th scope="col">Date et heure</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Etat</th>
          </tr>
        </thead>
    <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

    </tbody>
  </table>
          </div>
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
  </body>
</html>