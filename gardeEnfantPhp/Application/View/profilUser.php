<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10"><p class="profil">Mon profil</p></div>

    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->


            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
            </div></hr><br>






        </div><!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-item">
                <li class="active"><a data-toggle="tab" href="#Informations">Mes Informations&nbsp;/&nbsp;</a></li>
                <li><a data-toggle="tab" href="#enfant">Mes Enfants&nbsp;/&nbsp;</a></li>
                <li><a data-toggle="tab" href="#reservation">Mes réservations</a></li>

            </ul>


            <!-- INFOS PARENT PARTIE -->


            <div class="tab-content">
                <div class="spacer tab-pane active" id="Informations">
                    <p>Mes informations</p>

                    <div class="spacer2 container">

                        <hr>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Nom : </label> <span><?=$_SESSION['nomUser'];?></span>
                            </div>
                            <div class="text-right col-sm-6">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modificationInfos">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#enfantAjout">
                                    <i class="fas fa-edit"></i> Ajouter un enfant
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Prénom : </label> <span><?=$_SESSION['firstnameUser'];?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Email : </label> <span><?=$_SESSION['emailUser'];?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Téléphone </label> <span><?=$_SESSION['phoneUser'];?></span>
                            </div>
                        </div>


                    </div>

                </div><!--/tab-pane-->



                <!-- MES/MON ENFANTS PARTIE -->

                <div class="spacer tab-pane" id="enfant">

                    <p>Mes Enfants</p>

                    <div class="spacer2 container">
                        <?php foreach ($_SESSION['children'] as $child) {
                            $birthday = date_create($child['birthday']);
                            echo"
                            <hr>

                        <div class='row' >
                            <div class='col-sm-6' >
                                <label > Nom : </label > <span >". $child['name']."</span >
                            </div >
                            <div class='text-right col-sm-6' >
                                <button type = 'button' class='btn btn-success' data-toggle='modal' data-target= '#enfantInfos' >
                                    <i class='fas fa-edit' ></i > Modifier
                                </button >
                            </div >
                        </div >

                        <div class='row' >
                            <div class='col-sm-12' >
                                <label > Prénom : </label > <span >".$child['firstname']."</span >
                            </div >

                        </div >




                        <div class='row' >
                            <div class='col-sm-12' >
                                <label >Date de naissance :  </label > <span >".date_format($birthday,"d/m/Y")." </span >
                            </div >
                        </div >

                        <div class='row' >
                            <div class='col-sm-12' >
                                <label > Description : </label > <span>".$child['description']."</span >
                            </div >
                        </div >";
                        }

?>
                    </div>


                </div><!--/tab-pane-->
                <div class="spacer tab-pane" id="reservation">
                    <p>Mes réservations</p>
                    <table class="table table-hover table-stripped">
                        <thead>
                        <tr>
                            <th>
                                Jour
                            </th>
                            <th>
                                Heure de début
                            </th>
                            <th>
                                Heure de fin
                            </th>
                            <th>
                                Référence
                            </th>

                        </tr>


                        </thead>
                        <tbody>
                        <?php
                            foreach ($_SESSION['planning'] as $planning){
                                $date = date_create($planning['date']);
                                $debut = date_create($planning['begin']);
                                $fin = date_create($planning['end']);
                                echo"<tr><td>
                                        ".date_format($date,"d/m/Y")."
                                    </td>
                                    <td>".date_format($debut,"H:i")."</td>
                                    <td>".date_format($fin,"H:i")."</td>
                                    <td>".$planning['ref']."</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div><!--/tab-pane-->


        </div><!--/tab-content-->



    </div><!--/col-9-->
</div><!--/row-->



<!-- SECTION DES MODELS -->


<div class="modal fade" id="modificationInfos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier mes informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="user_name">Nom :</label>
                        <input type="text" name="user_name" class="form-control" value="<?=$_SESSION['nomUser'];?>">
                    </div>


                    <div class="form-group">
                        <label for="user_firstname">Prénom :</label>
                        <input type="text" class="form-control" name="user_firstname" value="<?=$_SESSION['firstnameUser'];?>">
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" name="user_email" value="<?=$_SESSION['emailUser'];?>">
                    </div>


                    <div class="form-group">
                        <label for="user_phone">Téléphone</label>
                        <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"
                               class="form-control" name="user_phone" value="<?=$_SESSION['phoneUser'];?>">
                    </div>

                    <input type="submit" name="update" value="Modifier" class="btn btn-success">
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>



<!-- INFOS ENFANT MODAL -->

<div class="modal fade" id="enfantInfos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de mon enfant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="child_name">Nom</label>
                        <input type="text" class="form-control" name="child_name" placeholder="Nom..">
                    </div>

                    <div class="form-group">
                        <label for="child_firstname">Prénom</label>
                        <input type="text" class="form-control" name="child_firstname" placeholder="Prénom..">
                    </div>

                    <div class="form-group">
                        <label for="child_birthday">Age</label>
                        <input type="date" class="form-control" name="child_birthday">
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <input type="submit" name="update_child" class="btn btn-success" value="Modifier">

                </form>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>



<!-- AGENDA ENFANT MODAL -->


<div class="modal fade" id="enfantAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de mon enfant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table table-hover table-stripped">
                    <thead>
                    <tr>
                        <th>
                            Jour
                        </th>
                        <th>
                            Heure Début
                        </th>
                        <th>
                            Heure Fin
                        </th>
                        <th>
                            Avec
                        </th>
                        <th>
                            Profil du Pro
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            09/12/18
                        </td>
                        <td>
                            12:00
                        </td>
                        <td>
                            16:00
                        </td>
                        <td>
                            Nathalie
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profilPro">
                                <i class="fas fa-eye"></i> Voir profil
                            </button>

                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Modifier</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="enfantAjout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un enfant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="child_name" class="form-control" id="nom" placeholder="Nom..">
                    </div>

                    <div class="form-group">
                        <label for="child_firstname">Prénom</label>
                        <input type="text" name="child_firstname" class="form-control" placeholder="Prénom..">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Date de naissance</label>
                        <input type="date" name="child_birthday" class="form-control" id="birthday" placeholder="Date de naissance..">
                    </div>


                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="child_description" class="form-control"></textarea>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <input type="submit" name="add_child" class="btn btn-success" placeholder="Ajouter">
            </div>
            </form>
        </div>
    </div>
</div>






    </div>
</div>
