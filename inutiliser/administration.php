   <?php
   session_start();
   include('BDD_auth.php');

if (!empty($_SESSION['typeuser'])){
   if ($_SESSION['typeuser'] === "Administrateur"){ // CONDITION ADMIN UNIQUEMENT SUR LA PAGE
   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Commandes consoles 
      $default_request = "SELECT * FROM users ORDER BY id_utilisateur DESC LIMIT 0,25";

      if (!empty($_POST['console'])){
         $console = $_POST['console'];

         if ($console == "command"){
            $error = "<center>

            <br> COMMANDES DE LA CONSOLE SUR LA TABLE : users <br>
            <br> Press 'entrer' pour reset la console
            <br> id  'id_utilisateur' ▶ recherche l'utilisateur correspondant à son id
            <br> pseudo  'pseudo' ▶ recherche l'utilisateur correspondant à son pseudo
            <br> limit  'a'  'b' ▶ a = commencement / b = nombre d'occurence
            <br> asc ▶ affiche de façon ascendente la table
            <br> desc ▶ affiche de façon ascendente la table
            <br> bannis ▶ recherche des bannis
            <br> modos ▶ recherche des modos
            <br> admins ▶ recherche des admins
            <br> users ▶ recherche des users
            <br> /chat ▶ Retour au chat
            <br> /deco ▶ Deconnexion
            </center> ";
            $request = $default_request;
         }
         elseif ($console == "asc"){
            $error = "Affichage de façon ascendante.";
            $request = "SELECT * FROM users ORDER BY id_utilisateur ASC LIMIT 0, 25";
         }
         elseif ($console == "/chat"){
            header('Location: chat.php');  
            exit(); 
         }
         elseif ($console == "/deco"){
            session_destroy();
            header('Location: index.php');  
            exit(); 
         }
         elseif ($console == "desc"){
            $error = "Affichage de façon descendante.";
            $request = $default_request;
         }
         elseif ($console =="bannis"){
            $error = "Affichage des utilisateurs bannis";
            $request = "SELECT * FROM users WHERE role = 666 ORDER BY id_utilisateur ASC";
         }
         elseif ($console =="modos"){
            $error = "Affichage des utilisateurs modos";
            $request = "SELECT * FROM users WHERE role = 2 ORDER BY id_utilisateur ASC";
         }
         elseif ($console =="admins"){
            $error = "Affichage des utilisateurs admins";
            $request = "SELECT * FROM users WHERE role = 1 ORDER BY id_utilisateur ASC";
         }
         elseif ($console =="users"){
            $error = "Affichage des users";
            $request = "SELECT * FROM users WHERE role = 0 ORDER BY id_utilisateur ASC";
         }
         elseif (stristr($console, 'id')){
            $num_id = intval(substr($console, 3));
            $error = "Affichage de l'user avec comme id_utilisateur = " . $num_id;
            $request = "SELECT * FROM users WHERE id_utilisateur = $num_id";
         }
         elseif (stristr($console, 'pseudo')){
            $pseudo = substr($console, 7);
            $error = "Affichage de l'user avec comme pseudo = " . $pseudo;
            $request = "SELECT * FROM users WHERE pseudo = '$pseudo'";
            }
         
         elseif (stristr($console, 'limit')){
            $limit_a = intval(substr($console, 6, -2));
            $limit_b = intval(substr($console, 8));
            $error = "Affichage de la table à partir du rang : " . $limit_a . " et nombre d'occurence fixé à :  ". $limit_b;
            $request = "SELECT * FROM users ORDER BY id_utilisateur ASC LIMIT $limit_a , $limit_b ";
            }
            
         else { // Si commande ne correspond à rien 
            $request = $default_request;
            $error = "La commande : " . $console ." n'existe pas.";
         }
      }
      else {
         $request = $default_request;
         $error = "Tapper 'command' pour obtenir les commandes de la console";
      }
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Affection rôle par les URL
      if(isset($_GET['type']) AND $_GET['type'] == 'admin') { // On recherche si dans la barre de recherche type = admin

         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role = 1 WHERE id_utilisateur = ?'); // rankup admin
            $req->execute(array($id_user));
         }
      } 
      elseif(isset($_GET['type']) AND $_GET['type'] == 'user') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role = 0 WHERE id_utilisateur = ?'); 
            $req->execute(array($id_user));
         }
      
      }
      elseif(isset($_GET['type']) AND $_GET['type'] == 'ban') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role = 666 WHERE id_utilisateur = ?'); 
            $req->execute(array($id_user));
         }
      
      }
      elseif(isset($_GET['type']) AND $_GET['type'] == 'unban') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role = 0 WHERE id_utilisateur = ?');
            $req->execute(array($id_user));
         }
      }
      elseif(isset($_GET['type']) AND $_GET['type'] == 'modo') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role = 2 WHERE id_utilisateur = ?');
            $req->execute(array($id_user));
         }
      }
      elseif(isset($_GET['type']) AND $_GET['type'] == 'del') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('DELETE FROM users WHERE id_utilisateur = ?');
            $req->execute(array($id_user));
         }
      }
      elseif(isset($_GET['type']) AND $_GET['type'] == 'kick') { 
      
         if(isset($_GET['confirme']) AND !empty($_GET['confirme'])) {
            $id_user = (int) $_GET['confirme'];
            $req = $dbco->prepare('UPDATE users SET role_instant = 1 WHERE id_utilisateur = ?');
            $req->execute(array($id_user));
         }
      }



      $membres = $dbco->query(" $request ");

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Affichage
      ?>
   <!DOCTYPE html>
   <html>
      <head>
         <meta charset="utf-8" />
         <title>Administration</title>
         <link rel="stylesheet" href="CSS/administration.css">
      </head>
      <body>
         <div class="container">
            <?php /// AFICHAGE GRAPHIQUE DE LA CONSOLE//
            if (!empty($error)){
               echo $error;
            }///////////////////////////////////////////
            ?>
            <br> <br>
            <table>
               <?php while($m = $membres->fetch()) { ?>
                  <tr>
                     <td align="left"><div class="arrayscroll"><?= $m['role'] ." | ". $m['id_utilisateur'] ." | ". $m['pseudo']." | ". $m['nom']." | ". $m['prenom']." | ". $m['email']." | ". $m['numero_de_telephone']." | ". $m['date_creation_compte']." | ". $m['ip_client']." | ". $m['avatar']  ?></div></td>
               
                     <?php   if(($m['role'] != 1) && ($m['role'] != 666)) { ?> <td><button><a href="administration.php?type=admin&confirme=<?= $m['id_utilisateur'] ?>">Rank Admin</a></button></td>
                     <?php } if(($m['role'] != 0) && ($m['role'] != 666)) { ?>  <td><button> <a href="administration.php?type=user&confirme=<?= $m['id_utilisateur'] ?>">Rank User</a></button></td>
                     <?php } if(($m['role'] != 2) && ($m['role'] != 666)) { ?> <td><button> <a href="administration.php?type=modo&confirme=<?= $m['id_utilisateur'] ?>">Rank Modo</a></button></td>
                     <?php } if($m['role'] != 666) { ?> <td><button><a href="administration.php?type=ban&confirme=<?= $m['id_utilisateur'] ?>">Bannir </a></button></td>
                     <?php } if($m['role'] == 666) { ?> <td><button><a href="administration.php?type=del&confirme=<?= $m['id_utilisateur'] ?>">Supprimer</a></button></td>
                     <?php } if($m['role'] == 666) { ?> <td><button><a href="administration.php?type=unban&confirme=<?= $m['id_utilisateur'] ?>">Unban</a></button></td>
                     <?php } if($m['role'] != 666) { ?> <td><button><a href="administration.php?type=kick&confirme=<?= $m['id_utilisateur'] ?>">Kick</a></button></td>

                     <?php }//close last if ?>
                  </tr>
                  <?php }// close while ?> 
            </table>
         </div>
         <footer>
            <div class="container">
               <form action="administration.php" method="POST">
                  <input type="text" size="80" name="console" autofocus autocomplete="off" />
               </form>
            </div>
         </footer>
      </body>

      <?php 
      }
      else {
         echo "Les utilisateurs de Rainbowlink n'ont pas accès à cette page";
         echo '<br><img alt="" src="https://media0.giphy.com/media/ac7MA7r5IMYda/giphy.gif" />';
      }
   }
   else {
      echo "Les visiteurs n'ont pas accès à cette page";
      echo '<br><img alt="" src="https://media0.giphy.com/media/ac7MA7r5IMYda/giphy.gif" />';
   }

      ?>

   </html>