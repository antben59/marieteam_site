<?php

session_start();
if(isset($_SESSION['grade_utilisateur'])){

    if($_SESSION['grade_utilisateur'] == 1){
        include('header.php');
        include('../db_connect.php');
        include('fonction.php');
        $consulter=false;

        $today = date("y-m-d"); 
        $today7 = date_outil($today,7);
        $today30 = date_outil($today,30);
        $today365 = date_outil($today,365);

        $aujourdhui = get_bdd()->query("SELECT SUM(prix) AS CHIFFRE_AFFAIRE, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant+quantiteVoitureInf4m+quantiteVoitureInf5m+quantiteFourgon+quantiteCampingCar+quantiteCamion) AS SOMME_PASS, count(num_reservation) AS NB_RESERVATION, count(DISTINCT(traversee.num_traversee)) AS NB_TRAVERSEE FROM reservation INNER JOIN traversee ON reservation.num_traversee = traversee.num_traversee WHERE date ='$today'")->fetch();
        $semaine = get_bdd()->query("SELECT SUM(prix) AS CHIFFRE_AFFAIRE, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant+quantiteVoitureInf4m+quantiteVoitureInf5m+quantiteFourgon+quantiteCampingCar+quantiteCamion) AS SOMME_PASS, count(num_reservation) AS NB_RESERVATION, count(DISTINCT(traversee.num_traversee)) AS NB_TRAVERSEE FROM reservation INNER JOIN traversee ON reservation.num_traversee = traversee.num_traversee WHERE date BETWEEN '$today7' AND '$today'")->fetch();
        $mois = get_bdd()->query("SELECT SUM(prix) AS CHIFFRE_AFFAIRE, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant+quantiteVoitureInf4m+quantiteVoitureInf5m+quantiteFourgon+quantiteCampingCar+quantiteCamion) AS SOMME_PASS, count(num_reservation) AS NB_RESERVATION, count(DISTINCT(traversee.num_traversee)) AS NB_TRAVERSEE FROM reservation INNER JOIN traversee ON reservation.num_traversee = traversee.num_traversee WHERE date BETWEEN '$today30' AND '$today'")->fetch();
        $annee = get_bdd()->query("SELECT SUM(prix) AS CHIFFRE_AFFAIRE, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant+quantiteVoitureInf4m+quantiteVoitureInf5m+quantiteFourgon+quantiteCampingCar+quantiteCamion) AS SOMME_PASS, count(num_reservation) AS NB_RESERVATION, count(DISTINCT(traversee.num_traversee)) AS NB_TRAVERSEE FROM reservation INNER JOIN traversee ON reservation.num_traversee = traversee.num_traversee WHERE date BETWEEN '$today365' AND '$today'")->fetch();
        
        //var_dump($aujourdhui);
        //var_dump($semaine);
        //var_dump($mois);
        //var_dump($annee);

    if(isset($_POST['consulter'])){
      $dateDebut = $_POST['dateDebut'];
      $dateFin = $_POST['dateFin'];
      //Différence de jour entre les 2 dates

      $date1 = new DateTime($_POST['dateDebut']);
      $date2 = new DateTime($_POST['dateFin']);
      $diff = $date2->diff($date1)->format("%a");

      if(strtotime($_POST['dateFin'])>strtotime($_POST['dateDebut'])){
        $informations = get_bdd()->query("SELECT SUM(prix) AS CHIFFRE_AFFAIRE, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant+quantiteVoitureInf4m+quantiteVoitureInf5m+quantiteFourgon+quantiteCampingCar+quantiteCamion) AS SOMME_PASS, SUM(quantiteAdulte+quantiteJunior+quantiteEnfant) AS QUANTITE_PASSAGER, SUM(quantiteVoitureInf4m+quantiteVoitureInf5m) AS QUANTITE_VEHINF, SUM(quantiteFourgon+quantiteCampingCar+quantiteCamion) AS QUANTITE_VEHSUP, SUM(quantiteAdulte) AS quantiteAdulte, SUM(quantiteJunior) AS quantiteJunior, SUM(quantiteEnfant) AS quantiteEnfant, SUM(quantiteVoitureInf4m) AS quantiteVoitureInf4m, SUM(quantiteVoitureInf5m) AS quantiteVoitureInf5m, SUM(quantiteFourgon) AS quantiteFourgon, SUM(quantiteCampingCar) AS quantiteCampingCar, SUM(quantiteCamion) AS quantiteCamion  FROM reservation INNER JOIN traversee ON reservation.num_traversee = traversee.num_traversee WHERE date BETWEEN '$dateDebut' AND '$dateFin'")->fetch();
        //var_dump($informations);
        $consulter=true;
      }

    }
?>
<div class="container">
<!-- Affichage par section (aujourd'hui, cette semaine, ce mois-ci, cette année) -->
  <section style="margin-top : 20px;">
    <h1 style="margin-bottom:20px;">Aujourd'hui</h1>
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de traversée</h5>
            <p class="card-text text-center"><?php echo $aujourdhui['NB_TRAVERSEE'];?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de passager</h5>
            <p class="card-text text-center"><?php if($aujourdhui['SOMME_PASS']==""){echo 0;}else{ echo $aujourdhui['SOMME_PASS'];}?> </p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de réservation</h5>
            <p class="card-text text-center"><?php echo $aujourdhui['NB_RESERVATION'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Chiffre d'affaires</h5>
            <p class="card-text text-center"><?php if($aujourdhui['CHIFFRE_AFFAIRE']==""){echo 0;}else{ echo $aujourdhui['CHIFFRE_AFFAIRE'];}?> </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section style="margin-top : 20px;">
    <h1 style="margin-bottom:20px;">Les 7 derniers jours</h1>
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de traversée</h5>
            <p class="card-text text-center"><?php echo $semaine['NB_TRAVERSEE'];?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de passager</h5>
            <p class="card-text text-center"><?php if($semaine['SOMME_PASS']==""){echo 0;}else{ echo $semaine['SOMME_PASS'];}?> </p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de réservation</h5>
            <p class="card-text text-center"><?php echo $semaine['NB_RESERVATION'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Chiffre d'affaires</h5>
            <p class="card-text text-center"><?php if($semaine['CHIFFRE_AFFAIRE']==""){echo 0;}else{ echo $semaine['CHIFFRE_AFFAIRE'];}?> </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section style="margin-top : 20px;">
    <h1 style="margin-bottom:20px;">Les 30 derniers jours</h1>
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de traversée</h5>
            <p class="card-text text-center"><?php echo $mois['NB_TRAVERSEE'];?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de passager</h5>
            <p class="card-text text-center"><?php if($mois['SOMME_PASS']==""){echo 0;}else{ echo $mois['SOMME_PASS'];}?> </p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de réservation</h5>
            <p class="card-text text-center"><?php echo $mois['NB_RESERVATION'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Chiffre d'affaires</h5>
            <p class="card-text text-center"><?php if($mois['CHIFFRE_AFFAIRE']==""){echo 0;}else{ echo $mois['CHIFFRE_AFFAIRE'];}?> </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section style="margin-top : 20px;">
    <h1 style="margin-bottom:20px;">Les 365 derniers jours</h1>
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de traversée</h5>
            <p class="card-text text-center"><?php echo $annee['NB_TRAVERSEE'];?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de passager</h5>
            <p class="card-text text-center"><?php if($annee['SOMME_PASS']==""){echo 0;}else{ echo $annee['SOMME_PASS'];}?> </p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Nombre de réservation</h5>
            <p class="card-text text-center"><?php echo $annee['NB_RESERVATION'] ?></p>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Chiffre d'affaires</h5>
            <p class="card-text text-center"><?php if($annee['CHIFFRE_AFFAIRE']==""){echo 0;}else{ echo $annee['CHIFFRE_AFFAIRE'];}?> </p>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Section -->
<section style="margin-top : 80px;">
  <h1>Consultation des statistiques</h1>
  <h4>Veuillez choisir les dates (début-fin) :</h4>
  <form method="POST">
    <div class="row g-3">
      <div class="col">
        <input type="date" name="dateDebut" class="form-control" required>
      </div>
      <div class="col">
        <input type="date" name="dateFin" class="form-control" required>
      </div>
      <div class="col">
        <button type="submit" name="consulter" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </form>
</section>
<section>
<?php
  if($consulter == true){
    ?>
  <h4 style="margin-top:50px;margin-bottom:20px;">Résultat :</h4>
  <?php
    $timestamp = strtotime($dateDebut); 
    $dateDebut = date("d-m-Y", $timestamp );

    $timestamp = strtotime($dateFin); 
    $dateFin = date("d-m-Y", $timestamp );
  ?>
  <h6><?php echo "Du ".$dateDebut." au ".$dateFin." ( ".$diff."jours )."; ?></h6>
  <table class="table table-bordered">
  <tr>
    <td>Chiffre d'affaire</td>
    <td><?php echo $informations['CHIFFRE_AFFAIRE']; ?></td>
  </tr>
  <tr>
    <td>Nombre de passagers transportés</td>
    <td><?php echo $informations['SOMME_PASS']; ?></td>
  </tr>
  <tr>
    <td>Nombre de passagers transportés par catégorie</td>
    <td>
      <ul>
        <li>
        Nombre de passager : <?php echo $informations['QUANTITE_PASSAGER']; ?>
        <br>
        <p><?php echo "(".$informations['quantiteAdulte']." adultes, ".$informations['quantiteJunior']." juniors et ".$informations['quantiteEnfant']." enfants)"; ?></p>
        </li>
        <li>
        Nombre de véhicule inf 2m : <?php echo $informations['QUANTITE_VEHINF']; ?>
        <br>
        <p><?php echo "(".$informations['quantiteVoitureInf4m']." véhicule inférieur 2m et ".$informations['quantiteVoitureInf5m']." véhicule supérieur 2m)"; ?></p>
        </li>
        <li>
        Nombre de véhicule sup 2m: <?php echo $informations['QUANTITE_VEHSUP']; ?>
        <br>
        <p><?php echo "(".$informations['quantiteFourgon']." Fourgon, ".$informations['quantiteCampingCar']." Camping Car et ".$informations['quantiteCamion']." Camions)"; ?></p>
        </li>
      </ul>

    </td>
  </tr>
</table>
    <?php
  }
  ?>
</section>



</div>


<?php
        include('footer.php');

    } else{
        header('location: ../error404.php');
    }
} else{
    header('location: ../error404.php');
}
