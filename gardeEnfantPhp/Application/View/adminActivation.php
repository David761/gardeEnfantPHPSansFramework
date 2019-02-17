<?php
if($_SESSION['Admin']==1) {


    ?>
    <form method="post" action="#">
        <div class="email form-group">
            <label for="email">Email :</label><input type="email" name="emailActive" class="form-control">
        </div>

        <div class="email form-group">
            <label for="nom">Nom :</label><input type="text" name="nomActive" class="form-control">
        </div>

        <input type="submit" value="Activer ce compte" name="activation" class="btn-success">
    </form>

    <?php
}else {
    echo "Accès non autorisé";
}