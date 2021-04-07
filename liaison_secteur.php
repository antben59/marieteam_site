<?php
require_once('db_connect.php');

    if(isset($_POST['secteur_id'])){
        $secteur_id = $_POST['secteur_id'];
?>
<select class="form-control" name="liaison" id="liaison">
    <?php
        $sql = get_bdd()->query("SELECT * from liaison where id_secteur='$secteur_id'");
        while($liste_liaison = $sql->fetch()){
        ?>
        <option value="<?= $liste_liaison['id']; ?>"><?= $liste_liaison['nom']; ?></option>
        <?php
    }
    ?>
</select>
<?php

}
?>