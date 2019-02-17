
<form method="post" action="<?=PUB_PATH?>/Professionnels/validation">
    <div class="email form-group">
        <label for="email">Email :</label><input type="email" name="email" class="form-control">
    </div>
    <div class="verif form-group">
        <label for="verif">Clé de vérification :</label><input type="text" name="verif" class="form-control">
    </div>
    <input type="submit" value="Activer mon compte" name="verification" class="btn-success">
</form>