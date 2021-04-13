    <!-- header -->
    <?php
        session_start();
        require_once('db_connect.php');
        $id_utilisateur = $_SESSION['id_utilisateur'];
        $infosUtilisateur = get_bdd()->query("SELECT * FROM utilisateurs where id='$id_utilisateur'")->fetch();

        if(isset($_POST['choix'])){
          $infosReservation = preg_split("/;/", $_POST['choix']);
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
                <a class="nav-link" href="admin/index.php">Administration</a>
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
              <h1 class="text-white">Vous souhaitez reservé ?</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section">
      <div class="container">
      <div class="text-center" style="margin-bottom:30px;">
          <h4>Liaison : <?php echo $infosReservation[0]; ?></h4>
          <h5> Traversée n°<?php echo $infosReservation[1]." le ".$infosReservation[2]. " à ".$infosReservation[3]; ?></h5>
      </div>

          <div class="col-md-12">
          <h5>Saisir les informations relatives à la réservation</h5>
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-5 form-group">
                  <label for="fname">Nom</label>
                  <input type="text" class="form-control form-control-lg" id="fname" placeholder="<?php echo $infosUtilisateur['nom'] ?>">
                </div>
                <div class="col-md-5 form-group">
                  <label for="lname">Prénom</label>
                  <input type="text" class="form-control form-control-lg" id="lname" placeholder="<?php echo $infosUtilisateur['prenom'] ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 form-group">
                  <label for="adresse">Adresse</label>
                  <input type="text" id="adresse" class="form-control form-control-lg">
                </div>
                <div class="col-md-3 form-group">
                  <label for="adresse">Code postale</label>
                  <input type="text" id="adresse" class="form-control form-control-lg">
                </div>
                <div class="col-md-3 form-group">
                  <label for="adresse">Ville</label>
                  <input type="text" id="adresse" class="form-control form-control-lg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-10 form-group">
                <table class="table table-bordered" style="margin-top:20px;">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Tarif en €</th>
                      <th scope="col">Quantité</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>Adulte</td>
                      <td>20.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Junior 8 à 18 ans</td>
                      <td>13.10</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Enfant 0 à 7 ans</td>
                      <td>7.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Voiture long.inf.4m</td>
                      <td>95.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Voiture long.inf.5m</td>
                      <td>140.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Fourgon</td>
                      <td>208.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Camping Car</td>
                      <td>226.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Camion</td>
                      <td>295.00</td>
                      <td>
                        <select class="form-control" id="exampleFormControlSelect1">
                          <option active>0</option>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 form-group">
                  <input type="submit" value="Enregistrer la réservation" class="btn btn-primary btn-lg btn-block">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    

    <section class="container cta-overlap">
      <div class="text d-flex">
        <h2 class="h3">Vous avez une question ?</h2>
        <div class="ml-auto btn-wrap">
          <a href="get-quote.html" class="btn-cta btn btn-outline-white">Nous contacter</a>
        </div>
      </div>
    </section>
    <!-- END section -->

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


          <?php
        }else{
          header('location:liaisons.php');
        }
    ?>
