<?php
session_start();
require_once('db_connect.php');
include('header.php');
?>
    <section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('img/slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Les liaisons</h1>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="section">
    <div class="container">
          <div class="col-md-12">
          <h5>Les liaisons proposées par secteur</h5>
          <table class="table table-bordered" style="text-align: center;">
        <thead>
          <tr>
            <th rowspan="2" style="vertical-align: middle;">Secteur</th>
            <th colspan="4">Liaison</th>
          </tr>
          <tr>
            <th>Code Liaison</th>
            <th>Distance en miles marin</th>
            <th>Port de départ</th>
            <th>Port d'arrivée</th>
          </tr>
        </thead>
        <tbody>
        <?php
        
          
          $req1 = get_bdd()->query("SELECT code_liaison, nom, distance_miles, id_secteur FROM liaison ORDER BY code_liaison ASC");
            while($donnees1 = $req1->fetch()){   

              $infosBateau = get_bdd()->query("SELECT nom FROM secteur WHERE id_secteur='$donnees1[3]'")->fetch();
              $nomSecteur = $infosBateau[0];?> 
<tr>

              <td><?php echo $nomSecteur; ?></td>
              <td><?php echo $donnees1[0]; ?></td>
              <td><?php echo $donnees1[2]; ?></td>
              
              <td><?php $port = explode("-", $donnees1[1]); echo $port[0]; ?></td>
              <td><?php echo $port[1]; ?></td>
</tr>





            <?php } ?>  
    

        <tbody>
        </table>


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