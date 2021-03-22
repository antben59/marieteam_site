<?php
session_start();

include('PhpTools/header.php');

if(!empty($_SESSION['admin'])){
  if($_SESSION['admin'] == true){
      header('location: PhpTools/administration.php');
  }
} else{ ?>

<section class="section">
      <div class="container">
        <div class="row">
      
          <div class="col-md-6">
         
            <form action="PhpTools/verifadmin.php" method="post">
              <div class="row"> <h1>Panel d'administration</h1>
                <div class="col-md-8 form-group">
                  <h2>Se connecter</h2>
                </div>
              <div class="col-md-8 form-group">
                  <label for="email">Login</label>
                  <input type="text" name="login"  id="login" class="form-control form-control-lg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 form-group">
                  <label for="mdp">Mot de passe</label>
                  <input type="password" name="mdp" id="mdp" class="form-control form-control-lg">
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 form-group">
                  <input type="submit" name ="sended" value="Connexion" class="btn btn-primary btn-lg btn-block">
                </div>
              </div>
            </form>    
          </div>

          </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    </body>

<?php include('PhpTools/footer.php');

} ?>