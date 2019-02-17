<div class="container spacer">
<form method="post" action="<?=PUB_PATH?>/User/validation">
    <div class="email form-group">
        <label for="email">Email :</label><input type="email" name="validUser" class="form-control">
    </div>
    <div class="verif form-group">
        <label for="verif">Clé de vérification :</label><input type="text" name="verifUser" class="form-control">
    </div>
    <input type="submit" value="Activer mon compte" name="verificationUser" class="btn-success">
</form>
</div>