<?php

session_start();

if(isset($_SESSION['grade_utilisateur'])){

    if($_SESSION['grade_utilisateur'] == 1){
        include('../db_connect.php');
        include('fonction.php');
        // ajouter liaison 
    if(isset($_POST['ajouter_liaison'])){
        $id_secteur = $_POST['secteur'];
        $id_port_depart = $_POST['depart'];
        $id_port_arrivee = $_POST['arrivee'];
        $miles = $_POST['miles'];
        $code_liaison = $_POST['code_liaison'];

        $nom_liaison = getNomPort($id_port_depart) . " - " . getNomPort($id_port_arrivee);

        if($id_port_depart != $id_port_arrivee){
            try{
                $sql = "INSERT INTO liaison(code_liaison,nom,distance_miles,id_secteur,port_depart,port_arrivee)values ('$code_liaison','$nom_liaison','$miles','$id_secteur','$id_port_depart','$id_port_arrivee')";
                $req = get_bdd()->prepare($sql);
                $req->execute();
            }
              catch (Exception $e) {
                  echo 'Exception reçue : ',  $e->getMessage(), "\n";  
            }
        }
        else{
            echo "<center>Impossible de créer la liaison \n Les ports saisis ne sont pas compatibles</center>";
        }
    }
  if(isset($_POST['ajouterTarification'])){

    $adulte = $_POST['adulte'];
    $junior = $_POST['junior'];
    $enfant = $_POST['enfant'];
    $vehlong4m = $_POST['vehlong4m'];
    $vehlong5m = $_POST['vehlong5m'];
    $fourgon = $_POST['fourgon'];
    $campingcar = $_POST['campingcar'];
    $camion = $_POST['camion'];
    $periode = $_POST['periode'];
    $codeLiaison = $_POST['code_liaison'];

      $sql = "INSERT INTO tarifer(dateDeb,code_liaison,num_type,tarif) values 
      ('$periode','$codeLiaison','1','$adulte'),
      ('$periode','$codeLiaison','2','$junior'),
      ('$periode','$codeLiaison','3','$enfant'),
      ('$periode','$codeLiaison','4','$vehlong4m'),
      ('$periode','$codeLiaison','5','$vehlong5m'),
      ('$periode','$codeLiaison','6','$fourgon'),
      ('$periode','$codeLiaison','7','$campingcar'),
      ('$periode','$codeLiaison','8','$camion')
      ";
      $req = get_bdd()->prepare($sql);
      $req->execute();

  }

  if(isset($_POST['ajouter_traversee'])){

    $code_liaison = intval($_POST['code_liaison']);
    $id_bateau = intval($_POST['id_bateau']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $numTraverseeMax = get_bdd()->query("SELECT max(num_traversee) FROM traversee")->fetch();
    $numTraverseeMax1 = $numTraverseeMax[0]+1;

    $sql = "INSERT INTO traversee (num_traversee, date, heure, code_liaison, id_bateau) VALUES ('$numTraverseeMax1','$date','$time','$code_liaison','$id_bateau')";
    $req = get_bdd()->prepare($sql);
    $req->execute();


  }
    if((isset($_GET['delete']))){
      $id = $_GET['delete'];
      $req = get_bdd()->prepare("DELETE FROM liaison WHERE code_liaison ='$id'");
      $sql = $req->execute();
    }

?>
   <!doctype html>
<html lang="fr">
  <head>
    <title>MarieTeam Administration</title>
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


    <!-- Theme Style -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/flaticon/font/flaticon.css">
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
                <a class="nav-link" href="index.php">Gestion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="statistique.php">Statistique</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../liaisons.php">Retour au site</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../deconnexion.php">Déconnexion</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
<div class="container" style="margin-top : 20px;">
  <div class="row">
      <div class="col">
        <section>
          <h1>Ajouter une liason</h1>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6 form-group">
                  <?php
                      $code_laison = 0;
                      $req = get_bdd()->query("SELECT * FROM liaison");
                      while ($data = $req->fetch()){
                        if($data['code_liaison'] > $code_laison) $code_laison = $data['code_liaison'];
                      }
                      $code_laison++;
                  ?>
                  <label for="code">Code liason</label>
                  <input type="text" value ="<?=$code_laison?>" class="form-control form-control" name="code_liaison" required>
                </div>
                  <div class="col-md-6 form-group">
                    <label for="depart">Secteur</label>
                    <select class="form-control form-control" name="secteur">
                      <?php 
                        $req = get_bdd()->query("SELECT * FROM secteur");
                        while ($data = $req->fetch()){
                        ?> 
                          <option value="<?=$data['id_secteur'];?>"><?= $data['nom']?></option>
                          <?php } ?>
                    </select>
                </div>
            </div>
              <div class="row">
                <div class="col-md-5 form-group">
                      <label for="depart">Port départ</label>
                      <select class="form-control form-control" name="depart">
                        <?php
                          $req = get_bdd()->query("SELECT * FROM port");
                          while ($data = $req->fetch()){
                        ?> 
                          <option value ="<?=$data['id_port'];?>"><?= $data['nom']?></option>
                        <?php } ?>
                      </select>
                    </div>
                <div class="col-md-5 form-group">
                      <label for="depart">Port arrivé</label>
                      <select class="form-control form-control" name="arrivee">
                        <?php
                          $req = get_bdd()->query("SELECT * FROM port");
                          while ($data = $req->fetch()){
                          ?> 
                          <option value ="<?=$data['id_port'];?>"><?= $data['nom']?></option>
                        <?php } ?>
                      </select>
                    </div>
                <div class="col-md-2 form-group">
                    <label for="code">Miles</label>
                    <input type="text" class="form-control form-control" name="miles" required>
                  </div>
              </div>
                <input type="submit" name="ajouter_liaison" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary"  value="Ajouter la liaison"></input>
            </form>
        </section>
      </div>
      <div class="col">
        <section>
          <h1>Supprimer des liaisons</h1>
          <?php
            $req = get_bdd()->query("SELECT * FROM liaison");
            while ($data = $req->fetch()){ 
          ?>
            <div class="row mb-3">
              <div class="col-6 themed-grid-col"><?=$data['nom']?></div>
              <div class="col-6 themed-grid-col"><a href="index.php?delete=<?=$data['code_liaison']?>">Supprimer</a></div>
            </div>
            <?php } ?>
        </section>
    </div>
</div>

<div class="container" style="margin-top : 20px;">
  <div class="row">
    <div class="col">
      <h1>Ajouter des traversées</h1>
        <form action="" method="post">
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="depart">Liaison</label>
              <select class="form-control form-control" name="code_liaison">
                <?php 
                  $req = get_bdd()->query("SELECT * FROM liaison");
                  while ($data = $req->fetch()){
                  ?>
                    <option value ="<?=$data['code_liaison'];?>"><?= $data['nom']?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="col-md-6 form-group">
            <label for="depart">Bateau</label>
              <select class="form-control form-control" name="id_bateau">
                <?php
                  $req = get_bdd()->query("SELECT * FROM bateau");
                  while ($data = $req->fetch()){
                  ?>
                  <option value ="<?=$data['id_bateau'];?>"><?= $data['nom']?></option>
                  <?php } ?>
              </select>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="depart">Date</label>
              <input type="date" class="form-control form-control" name="date" required>
            </div>
            <div class="col-md-6 form-group">
              <label for="depart">Horaire</label>
              <input type="time" class="form-control form-control" name="time" required>
            </div>
          </div>


        <input type="submit" name="ajouter_traversee" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary"  value="Ajouter la traversée"></input>
        </form>
        

        <h1>Ajout d'une tarification :</h1>
        <form action="" method="post">
        <div class="row">

            <div class="col-md-6 form-group">
              <label for="depart">Période</label>
                <select class="form-control form-control" name="periode">
                  <?php 
                    $req = get_bdd()->query("SELECT * FROM periode");
                    while ($data = $req->fetch()){
                    ?>
                      <option value ="<?=$data['dateDeb'];?>"><?= $data['dateDeb']." - ".$data['dateFin']?></option>
                    <?php } ?>
              </select>
            </div>

            <div class="col-md-6 form-group">
              <label for="depart">Liaison</label>
                <select class="form-control form-control" name="code_liaison">
                  <?php 
                    $req = get_bdd()->query("SELECT * FROM liaison");
                    while ($data = $req->fetch()){
                    ?>
                      <option value ="<?=$data['code_liaison'];?>"><?= $data['nom']?></option>
                    <?php } ?>
              </select>
            </div>

          </div>
        <div class="row">
            <div class="col-md-3 form-group">
              <label for="adulte">Adulte</label>
              <input type="text" class="form-control form-control" name="adulte" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="junior">Junior</label>
              <input type="text" class="form-control form-control" name="junior" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="enfant">Enfant</label>
              <input type="text" class="form-control form-control" name="enfant" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="vehlong4m">Véhicule long inf 4m</label>
              <input type="text" class="form-control form-control" name="vehlong4m" required value="0">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 form-group">
              <label for="vehlong5m">Véhicule long inf 5m</label>
              <input type="text" class="form-control form-control" name="vehlong5m" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="fourgon">Fourgon</label>
              <input type="text" class="form-control form-control" name="fourgon" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="campingcar">CampingCar</label>
              <input type="text" class="form-control form-control" name="campingcar" required value="0">
            </div>
            <div class="col-md-3 form-group">
              <label for="camion">Camion</label>
              <input type="text" class="form-control form-control" name="camion" required value="0">
            </div>
          </div>
          <input type="submit" name="ajouterTarification" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary"  value="Ajouter la tarification"></input>
        </form>




    </div>
  </div>
</div>
<footer style="margin-top:200px;" class="text-center" role="contentinfo">   
        <div class="row">
          <div class="col-md-12">
            <p>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> MarieTeam  <i class="fa fa-heart text-danger" aria-hidden="true"></i>
            </p>
          </div>
      </div>
</footer>
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/main.js"></script>
    <?php
    
  
    } else{
        header('location: ../error404.php');
    }
} else{
    header('location: ../error404.php');
}
