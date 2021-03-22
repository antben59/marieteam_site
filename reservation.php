    <!-- header -->
    <?php include('PhpTools/header.php');?>
    <!-- header -->
    
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
          <h4>Liaison : Quiberon- Le Palais</h4>
          <h5> Traversée n°2585 le 12/11/2020</h5>
      </div>

          <div class="col-md-12">
          <h5>Saisir les informations relatives à la réservation</h5>
            <form action="#" method="post">
              <div class="row">
                <div class="col-md-5 form-group">
                  <label for="fname">Nom</label>
                  <input type="text" class="form-control form-control-lg" id="fname">
                </div>
                <div class="col-md-5 form-group">
                  <label for="lname">Prénom</label>
                  <input type="text" class="form-control form-control-lg" id="lname">
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
