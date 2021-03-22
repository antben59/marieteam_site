    <!-- header -->
    <?php
    include('PhpTools/header.php');
    require('bddTools.php');

    date_default_timezone_set('Europe/Paris');
    $today = date('d/m/Y');
    ?>
    <!-- header -->

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
