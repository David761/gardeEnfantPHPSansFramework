<form method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" id="nom" placeholder="Nom.." name="name">
    </div>


    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Adresse Email.." name="email">
    </div>

    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" placeholder="Mot de passe.." name="password">
    </div>

    <div class="form-group">
        <label for="tel">Téléphone</label>
        <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"
               class="form-control" id="tel" placeholder="Numéro de téléphone.." name="phone">
    </div>

    <div class="form-group">
        <label for="address">Adresse</label>
        <textarea name="address" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="agrement">N° D'agrément</label>
        <input type="text"
               class="form-control" id="agrement" placeholder="Numéro d'aggrément.." name="agreement">
    </div>

    <div class="form-group">
        <label for="siret">N°SIRET</label>
        <input type="text"
               class="form-control" id="siret" placeholder="Numéro de Siret.." name="siret">
    </div>

    <div class="form-group">
        <label for="agrement">Prix/heure</label>
        <input type="text"
               class="form-control" id="price" placeholder="prix" name="price">
    </div>

    <div class="form-group">
        <label for="picture">Image</label>
        <input type="file"
               class="form-control" id="picture" name="picture">
    </div>







    <div class="form-group text-center">


        <input type="submit" name="register" value="S'inscrire" class="btn btn-success">
        <input type="reset" value="Effacer" class="btn btn-danger">


    </div>

</form>

