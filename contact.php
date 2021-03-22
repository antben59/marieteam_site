    <!-- header -->
    <?php include('PhpTools/header.php');?>
    <!-- header -->
    
    <section class="inner-page">
      <div class="slider-item py-5" style="background-image: url('img/slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="text-white">Besoin d'aide ?</h1>
            </div>
          </div>
        </div>

      </div>
    </section>
    
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="nom">Nom</label>
                  <input type="text" class="form-control form-control-lg" id="nom" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="prenom">Prénom</label>
                  <input type="text" class="form-control form-control-lg" id="prenom" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control form-control-lg" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="objet">Objet</label>
                    <select class="form-control form-control-lg" id="objet">
                      <option>Demande de renseignement</option>
                      <option>Demande de modification</option>
                      <option>Demande d'annulation</option>
                      <option>Autres..</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="message">Message</label>
                  <textarea name="message" id="message" class="form-control form-control-lg" cols="30" rows="8" required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Envoyer votre message" class="btn btn-primary btn-lg btn-block">
                </div>
              </div>
              <?php
                    $retour = mail('dylan.decool14@gmail.com', 'fghjk', 'dfghj', 'fghjk');
                    if($retour) {
                        echo '<p>Votre message a bien été envoyé.</p>';
                    }else
                    {
                        echo '<p>Une erreur c\'est produite lors de l\'envois de l\'email.</p>';
                    }
              ?>
            </form>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-4">
            <h5 class="text-uppercase mb-3">Adresse</h5>
            <p class="mb-5">34 rue de la paix, <br> Lille <br> France</p>
            
            <h5 class="text-uppercase mb-3">Email</h5>
            <p class="mb-5"><a href="mailto:info@marieteam.com">info@marieteam.com</a> <br> <a href="mailto:contact@marieteam.com">contact@marieteam.com</a></p>
            
            <h5 class="text-uppercase mb-3">Téléphone</h5>
            <p class="mb-5">+33 8 25 12 89 85</p>
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