<?php
session_start();
require_once('db_connect.php');

if (isset($_SESSION["id_utilisateur"])) {

  $id_utilisateur = $_SESSION['id_utilisateur'];
  $reservationParPage = 5;
  $reservationTotalesReq = get_bdd()->prepare("SELECT num_reservation FROM reservation WHERE id_utilisateurs='$id_utilisateur'");
  $reservationTotalesReq->execute();

  $reservationTotales = $reservationTotalesReq->rowCount();
  $pagesTotales = ceil($reservationTotales/$reservationParPage);

  if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
      $_GET['page'] = intval($_GET['page']);
      $pageCourante = $_GET['page'];
  } else {
      $pageCourante = 1;
  }
  $depart = ($pageCourante-1)*$reservationParPage;
}
else{
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
            <h1>Récapitulatif</h1><br>
          <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nom Prénom</th>
            <th scope="col">Réservation</th>
            <th scope="col">Traversée</th>
            <th scope="col">Bateau</th>
            <th scope="col">Date</th>
            <th scope="col">Etat</th>
          </tr>
        </thead>
    <tbody>
    <?php


     $req = get_bdd()->query('SELECT * FROM reservation where	id_utilisateurs='.$id_utilisateur.' ORDER BY num_reservation DESC LIMIT '.$depart.','.$reservationParPage);
      while ($donnees = $req->fetch()){
    ?>
      <tr>
      <?php
      $infosUtilisateurReservation = get_bdd()->query("SELECT nom, prenom FROM utilisateurs WHERE id='$id_utilisateur'")->fetch();
      $num_traversee = $donnees['num_traversee'];
      $infosBateau = get_bdd()->query("SELECT id_bateau, date, heure FROM traversee WHERE num_traversee='$num_traversee'")->fetch();
      $id_bateau = $infosBateau[0];
      $date_traversee = $infosBateau[1];
      $heure_traversee = $infosBateau[2];

      $infosNomBateau = get_bdd()->query("SELECT nom FROM bateau WHERE id_bateau='$id_bateau'")->fetch();
     
      
      ?>
        <td><?php echo ucwords($infosUtilisateurReservation['nom']." ".$infosUtilisateurReservation['prenom']); ?></td>
        <td><?php echo $donnees['num_reservation']; ?></td>
        <td><?php echo $num_traversee; ?></td>

        <td><?php echo $infosNomBateau['nom']; ?></td>
        <td><?php echo $date_traversee." à ".substr($heure_traversee, 0, -3); ?></td>
        <td>Valider</td>
      </tr>
<?php } ?>
    </tbody>
  </table>
  <?php
      for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="mes-reservations.php?page='.$i.'">'.$i.'</a> ';
         }
      }
      ?>
                <p>Merci de l'intêret que vous porter à la compagnie Marieteam.</p>
                <p>En récompense tout les 5 réservations vous revez automatiquement part mail un bon de réduction de 20% utilisable sur votre prochaine réservation.</p>

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