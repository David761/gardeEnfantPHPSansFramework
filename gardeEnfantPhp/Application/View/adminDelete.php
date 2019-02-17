<?php
if($_SESSION['Admin']==1) {


    ?>
    <form method="post" action="#">
        <div class="email form-group">
            <label for="email">Email :</label><input type="email" name="emailDelete" class="form-control">
        </div>

        <div class="email form-group">
            <label for="nom">Nom :</label><input type="text" name="nomDelete" class="form-control">
        </div>

        <input type="submit" value="Supprimer ce compte" name="delete" class="btn-danger">
    </form>

    <?php
}else{
    echo "Accès non autorisé";
}