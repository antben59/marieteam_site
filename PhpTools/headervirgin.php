<!doctype html>
<html lang="fr">
  <head>
    <title>MarieTeam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=K2D:400,700|Niramit:300,700" rel="stylesheet">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../css/jquery.timepicker.css">

    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <!-- Theme Style -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Sweet Alert -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
            <a class="nav-link" href="../index.php">Accueil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../liaisons.php">Liaisons</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../tarifs.php">Tarifs</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../horaires.php">Horaires</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../reservation.php">Réservation</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../contact.php">Contact</a>
            </li>
            <li class="nav-item">

      <?php if(isset($_SESSION['admin'])){
        if($_SESSION['admin'] == true){
          ?>
          <a class="nav-link" href="administration.php">Panel d'administration</a>
          <?php
        }
      }
      else{
        ?>
        <a class="nav-link" href="admin.php">Panel d'administration</a>
        <?php
      }
      ?>
</li>
        </ul>
        </div>
    </div>
    </nav>
</header>