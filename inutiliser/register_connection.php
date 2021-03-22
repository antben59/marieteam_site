    <!-- header -->
    <?php 
    include('PhpTools/header.php');
    ?>

    <!-- header -->
    <!-- // J'ai enlevé l'image pour le moment, je la trouve inutile et genante pour l'alerte, mais c'est possible de la remettre et ça marche très bien.

        <section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('img/slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Nous-rejoindre ?</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
  -->
    
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          
            <form action="" method="post">
              <div class="row">
                <div class="col-md-8 form-group">
                  <h2>Se connecter</h2>
                </div>
              <div class="col-md-8 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" id="mdp" class="form-control form-control-lg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 form-group">
                  <input type="submit" value="Connexion" class="btn btn-primary btn-lg btn-block">
                </div>
              </div>
            </form>
          </div>
          
          <div class="col-md-6">
          <form action="PhpTools/dataForm.php" method="post">  <!-- INSCRIPTION to register.php post method  -->
              <div class="row">
              <div class="col-md-8 form-group">
                  <h2>S'inscrire</h2>
                </div>
                <div class="col-md-6 form-group">
                  <label for="fname">Nom</label>
                  <input type="text" class="form-control form-control-lg" name = "firstname" id="firstname">
                </div>
                <div class="col-md-6 form-group">
                  <label for="lname">Prénom</label>
                  <input type="text" class="form-control form-control-lg" name="name" id="name">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email"  class="form-control form-control-lg" name="email" id="email">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" class="form-control form-control-lg" name ="mdp" id="mdp">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" name ="sendregister" value="S'inscrire" class="btn btn-primary btn-lg btn-block">
                </div>
              </div>
            </form>                               <!-- END INSCRIPTION to register.php post method  -->
          </div>
        </div>
      </div>
    </section>
    
    <section class="section border-t">
      <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
          <div class="col-md-8 text-center mb-5">
            <h2 class="text-uppercase heading border-bottom mb-4">Testimonial</h2>
            <p class="mb-0 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 element-animate">
            <div class="media d-block media-testimonial text-center">
              <img src="img/person_1.jpg" alt="Image placeholder" class="img-fluid mb-3">
              <p>Jane Doe, <a href="#">XYZ Inc.</a></p>
              <div class="media-body">
                <blockquote>
                  <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.&rdquo;</p>  
                </blockquote>

              </div>
            </div>
          </div>

          <div class="col-md-6 element-animate">
            <div class="media d-block media-testimonial text-center">
              <img src="img/person_3.jpg" alt="Image placeholder" class="img-fluid mb-3">
              <p>John Doe, <a href="#">XYZ Inc.</a></p>
              <div class="media-body">
                <blockquote>
                  <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.&rdquo;</p>  
                </blockquote>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="container cta-overlap">
      <div class="text d-flex">
        <h2 class="h3">Contact Us For Projects or Need a Quotations</h2>
        <div class="ml-auto btn-wrap">
          <a href="get-quote.html" class="btn-cta btn btn-outline-white">Get A Quote</a>
        </div>
      </div>
    </section>
    <!-- END section -->
    <!-- footer -->
    <?php include('PhpTools/footer.php');
     // Permet d'ajouter les popups / alert lors de la création du compte.
    ?>
    
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