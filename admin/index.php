<?php

session_start();

if(isset($_SESSION['grade_utilisateur'])){

    if($_SESSION['grade_utilisateur'] == 1){
        include('header.php');
        include('../db_connect.php');
        include('fonctions.php');
        // ajouter liaison 
    if(isset($_POST['ajouter_liaison'])){

        $nom_secteur = $_POST['secteur'];
        $nom_port_depart = $_POST['depart'];
        $nom_port_arrivee = $_POST['arrivee'];

        $miles = $_POST['miles'];
        $code_liaison = $_POST['code_liaison'];
        $id_secteur = getIdSecteur($nom_secteur);
        $id_port_depart = getIdPort($nom_port_depart);
        $id_port_arrivee = getIdPort($nom_port_arrivee);
        $nom_liaison = $nom_port_depart . " " . $nom_port_arrivee;

        if($id_port_depart != $id_port_arrivee){
            try{
                $sql = "INSERT INTO liaison(
                    code_liaison,
                    nom,
                    distance_miles,
                    id_secteur,
                    port_depart,
                    port_arrivee
                    )
                    values (
                    '$code_liaison',
                    '$nom_liaison',
                    '$miles',
                    '$id_secteur',
                    '$id_port_depart',
                    '$id_port_arrivee'
                    )";
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

    if((isset($_GET['delete']))){
      $id = $_GET['delete'];
      $req = get_bdd()->prepare("DELETE FROM liaison WHERE code_liaison ='$id'");
      $sql = $req->execute();
    }

?>

 <section class="section">
      <div class="container">
      <h2>Ajouter une liason</h2>

        <div class="row">
          <div class="col-md-7">
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
                  <input type="text" value ="<?=$code_laison?>" class="form-control form-control-lg" name="code_liaison" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="depart">Secteur</label>
                  <select class="form-control form-control-lg" name="secteur">
                  <?php 
                  $req = get_bdd()->query("SELECT * FROM secteur");
                  while ($data = $req->fetch()){
                    ?> <option><?= $data['nom']?></option><?php
                  }
                  ?>
                    </select>
                </div>
              </div>
              <div class="row">
              <div class="col-md-5 form-group">
                  <label for="depart">Port départ</label>
                  <select class="form-control form-control-lg" name="depart">
                  <?php
                    $req = get_bdd()->query("SELECT * FROM port");
                  while ($data = $req->fetch()){
                    ?> <option><?= $data['nom']?></option><?php
                  }
                  ?>
                    </select>
                </div>
                <div class="col-md-5 form-group">
                  <label for="depart">Port arrivé</label>
                  <select class="form-control form-control-lg" name="arrivee">
                  <?php
                    $req = get_bdd()->query("SELECT * FROM port");
                  while ($data = $req->fetch()){
                    ?> <option><?= $data['nom']?></option><?php
                  }
                  ?>
                    </select>
                </div>
                <div class="col-md-2 form-group">
                  <label for="code">Miles</label>
                  <input type="text" class="form-control form-control-lg" name="miles" required>
                </div>
              </div>
              <input type="submit" name="ajouter_liaison" style="text-align:center;margin : 20px 0 40px 0;" class="btn btn-primary"  value="Ajouter la liaison"></input>
              </form>
          </div>


      </div>
    </section>
    <div class="container">
    
    <h2 class="mt-4">Supprimer des liaisons</h2>

<?php
$req = get_bdd()->query("SELECT * FROM liaison");
while ($data = $req->fetch()){ 
    
    ?><div class="row mb-3">
    <div class="col-6 themed-grid-col"><?=$data['nom']?></div>
    <div class="col-6 themed-grid-col"><a href="index.php?delete=<?=$data['code_liaison']?>">Supprimer</a></div>

    </div><?php
}?>
</div>

    <?php
    
    
    } else{
        header('location: ../error404.php');
    }
} else{
    header('location: ../error404.php');
}
