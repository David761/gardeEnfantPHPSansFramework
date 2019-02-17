<div class="container spacer">
    <form method="post" action="<?=PUB_PATH?>/Security/newPasswordUser">
        <div class="form-group">
            <label for="emailPro">Email :</label>
            <input type="email" class="form-control" name="emailUser" required>
        </div>
        <div class="form-group">
            <label for="clePro">Clé de vérification :</label>
            <input type="text" class="form-control" name="cleUser" required>
        </div>
        <div class="form-group">
            <label for="newPassPro">Nouveau mot de passe :</label>
            <input type="password" class="form-control" name="newPassUser" required>
        </div>
        <input type="submit" name="submit" value="Confirmer" class="btn btn-success">
    </form>
</div>