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
              <h1 class="text-white">Les tarifs</h1>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="col-md-12">
          <h5>Les tarifs proposées par liaison</h5>
          <?php 
            $req1 = get_bdd()->query("SELECT * FROM liaison");
            $req2 = get_bdd()->query("SELECT dateDeb, dateFin FROM periode ORDER BY dateDeb ASC");

            while($donnees1 = $req1->fetch()){
          ?>
          <table class="table table-bordered" style="text-align: center;">
            <thead>
              <tr>
                <th colspan="6">Liaison <?php echo $donnees1['code_liaison'] ?> : <?php echo $donnees1['nom'] ?></th>
              </tr>
              <tr>
                <th rowspan="2" style="vertical-align: middle;">Catégorie</th>
                <th rowspan="2" style="vertical-align: middle;">Type</th>
                <th colspan="4">Période</th>
              </tr>
              <tr>
                <?php
                  $aujourdhui = get_bdd()->query("SELECT count(lettre_categorie) FROM type")->fetch();
                  while($donnees2 = $req2->fetch()){ 
                ?>
                  <th><?php echo $donnees2['dateDeb'] ?><br><?php echo $donnees2['dateFin'] ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php
              
            ?>
              <tr>
                <td rowspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td rowspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td rowspan="3"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            <tbody>
          </table>
          <?php } ?>
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