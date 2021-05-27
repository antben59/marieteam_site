<?php

session_start();

if(isset($_SESSION['grade_utilisateur'])){

    if($_SESSION['grade_utilisateur'] == 1){
        include('header.php');
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

    // probleme d'ajout d'une traversée dans la bdd
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
    </div>
  </div>
</div>

    <?php
    
    include('footer.php');
  
    } else{
        header('location: ../error404.php');
    }
} else{
    header('location: ../error404.php');
}
