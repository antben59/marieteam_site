<?php
session_start();
require_once('db_connect.php'); ?>
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
                <a class="nav-link" href="/admin/index.php">Panel d'administration</a>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <section class="section">
          <div class="row justify-content-center mb-5 element-animate">
          <div class="col-md-8 text-center">
            <h2 class="text-uppercase heading border-bottom mb-4">Services</h2>
            <p class="mb-3 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
          </div>
        </div>
      </div>
      <div class="container">
          <div class="col-md-12">
          <h5>Choisir les informations relatives à la liaison</h5>
          <div class="alert alert-danger" role="alert">ERROR 402 : Base de données compromis</div>
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="secteur">Secteur</label>

                  <select class="form-control" id="secteur">
                  <option value="0"; ?>Séléctionnez votre secteur</option>
          
                  <?php
                  $secteur = $dbco->query('SELECT nom, id_secteur FROM secteur GROUP BY nom ORDER BY nom ASC');
                  while($liste_secteur = $secteur->fetch())
                  {
                  ?>
                          <option value="<?= $liste_secteur['id_secteur']; ?>"><?= $liste_secteur['nom']; ?></option>
                  <?php } ?>
                        </select>

                </div>
                <div class="col-md-4 form-group">
                  <label for="liaison">Liaison</label>

                  <select class="form-control" id="liaison">
                  
                  <option value="0"; ?>Séléctionnez votre liaison</option>

                  </select>
                
                </div>
                <div class="col-md-4 form-group">
                  <label for="date">Date</label>
                  <input class="form-control" type="date" value="" id="date">
                </div>
              </div>
             
              <div class="row justify-content-center">
                <div class="col-md-4 form-group">
                  <input type="submit" style="margin:30px;" value="Afficher les traversées" class="btn btn-primary btn-md btn-block">
                </div>
              </div>
            </form>
<!--
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
                  <tr>
                    <td style="text-align:center;">541197</td>
                    <td style="text-align:center;">07:45</td>
                    <td style="text-align:center;">Kor' Ant</td>
                    <td style="text-align:center;">238</td>
                    <td style="text-align:center;">11</td>
                    <td style="text-align:center;">2</td>
                  </tr> 
                  </tbody>
                </table>
            -->
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
