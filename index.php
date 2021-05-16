<?php
session_start();
require_once('db_connect.php'); 
include('header.php');

?>
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('img/Photo-slider-1.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 class="mb-4">MarieTeam vous transporte en sécurité depuis 20 ans</h1>              
            </div>
          </div>
        </div>

      </div>
        
      </div>

    </section>
    <!-- END slider -->

    <section class="section bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 pr-lg-5 mb-5 mb-md-0  element-animate">
            <div class="pr-lg-5">
              <h2 class="text-uppercase heading border-bottom mb-4 text-left">Expert du<br>transport maritime</h2>
                <p> Dans le milieu du transport maritime depuis 2000, nous avons le plaisir de vous accueillir sur nos bateaux afin de partager une traversée agréable. </p>
                <p>MarieTeam vous propose de vous déplacer dans toute la Bretagne facilement et rapidement et tout ceci, en toute sécurité.</p>
            </div>
          </div>
          <div class="col-md-6  element-animate">
            <img src="img/pilote_bateau.jpg" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>


    <section class="section">
      <div class="container">

        <div class="row justify-content-center mb-5 element-animate">
          <div class="col-md-8 text-center">
            <h2 class="text-uppercase heading border-bottom mb-4">Services</h2>
            <p class="mb-3 lead">Nous vous permettons de vous déplacer sur plusieurs iles de Bretagne aux paysages saints et apaisants comme Belle-Ile-en-Mer, Houat et bien d'autres !</p>
          </div>
        </div>

        <div class="row mb-5">

          <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
            <div class="media d-block media-feature text-center">
            <ion-icon size="large" name="boat-outline"></ion-icon>
              <div class="media-body">
                <h3 class="mt-0 text-black">Nos traversées</h3>
                <p>Toutes nos liaisons et traversées en un clic.</p>
                <p><a href="liaisons.php" class="btn btn-outline-primary btn-sm">En savoir plus</a></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
            <div class="media d-block media-feature text-center">
            <ion-icon size="large" name="cash-outline"></ion-icon>
            
              <div class="media-body">
                <h3 class="mt-0 text-black">Nos tarifs</h3>
                <p>Des prix attirants pour tous les passagers et véhicules.</p>
                <p><a href="tarifs.php" class="btn btn-outline-primary btn-sm">En savoir plus</a></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
            <div class="media d-block media-feature text-center">
            <ion-icon size ="large" name="time-outline"></ion-icon>
                <div class="media-body">
                <h3 class="mt-0 text-black">Nos horaires</h3>
                <p>Une plage horaire de toute la semaine.</p>
                <p><a href="horaires.php" class="btn btn-outline-primary btn-sm">En savoir plus</a></p>
              </div>
            </div>
          </div>



          
        </div>
        <!-- END row -->
    </section>
    <!-- END section -->

    
    <section class="section">
      <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
          <div class="col-md-8 text-center mb-5">
            <h2 class="text-uppercase heading border-bottom mb-4">Nos avis clients</h2>
            <p class="mb-0 lead"></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 element-animate">
            <div class="media d-block media-testimonial text-center">
              <img src="img/person_1.jpg" alt="Image placeholder" class="img-fluid mb-3">
              <p>Raphaëlle Lupja<a href="#"></a></p>
              <div class="media-body">
                <blockquote>
                  <p>&ldquo;Avant de rejoindre l'ile de Houat, nous avons appris l'existence d'autres iles très jolies où vivent uniquement des animaux sauvages ! C'était très beau à voir, merci pour cette découverte. Le voyage était de ce fait bien plus agréable et instructif que prévu.&rdquo;</p>
                </blockquote>

              </div>
            </div>
          </div>

          <div class="col-md-6 element-animate">
            <div class="media d-block media-testimonial text-center">
              <img src="img/person_3.jpg" alt="Image placeholder" class="img-fluid mb-3">
              <p>Adrien Bijblaken<a href="#"></a></p>
              <div class="media-body">
                <blockquote>
                  <p>&ldquo;Très satisfait de la traversée ! Nous avons, avec ma femme et mes deux enfants, eu l'occasion de faire la traversée pour Belle-Ile-en-Mer en partant de Quiberon et ce fut un réel plaisir. Le bateau était propre et l'équipage agréable et rassurant pour les plus craintifs  . Je recommande !&rdquo;</p>
                </blockquote>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <section class="container cta-overlap">
      <div class="text d-flex">
        <h2 class="h3">Vous avez une question ?</h2>
        <div class="ml-auto btn-wrap">
          <a href="contact.php" class="btn-cta btn btn-outline-white">Nous-contactez</a>
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
