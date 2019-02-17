<?php
session_start();
if($_SESSION['login']==1 && $_SESSION['loginPro']==1){

    ?>
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-10"><p class="profil">Mon profil</p></div>

        </div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->


                <div class="text-center">
                    <img src="<?= PUB_PATH?>/public/upload/<?=$_SESSION['picture'] ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                </div></hr><br>






            </div><!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-item">
                    <li class="active"><a data-toggle="tab" href="#Informations">Mes Informations&nbsp;/&nbsp; </a></li>
                    <li><a data-toggle="tab" href="#Agenda">Mon Agenda&nbsp;/&nbsp; </a></li>
                    <li><a data-toggle="tab" href="#Gardes">Mes Gardes</a></li>
                </ul>


                <div class="tab-content">
                    <div class="spacer tab-pane active" id="Informations">
                        <p>Mes informations</p>

                        <div class="spacer2 container">

                            <hr>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Nom : </label> <span><?php echo $_SESSION['nom'];?></span>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modificationInfos">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Email : </label> <span><?php echo $_SESSION['email'];?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Adresse : </label> <span><?php echo $_SESSION['address'];?> </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Téléphone </label> <span><?php echo $_SESSION['phone'];?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>N° SIRET : </label> <span><?php echo $_SESSION['siret'];?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label>N° Agrément : </label> <span><?php echo $_SESSION['agreement'];?></span>
                                </div>
                            </div>



                        </div>



                    </div><!--/tab-pane-->
                    <div class="spacer tab-pane" id="Agenda">

                        <p>Mon Agenda</p>

                        <hr>
                        <?php if($_SESSION['active']!=1){
                            echo "Votre compte n'a pas encore été validé";
                        } else {?>

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
                                    Places disponibles
                                </th>

                            </tr>


                            </thead>

                            <tbody>
                            <?php

                            foreach ($_SESSION['date1'] as $datas) {
                                $date = date_create($datas['date']);
                                $begin = date_create($datas['begin']);
                                $end = date_create($datas['end']);
                                echo"<tr>
                                <td >".
                                    date_format($date,"d/m/Y")
                                ."</td >
                                <td >".
                                date_format($begin,"H:i")
                                ."</td >
                                <td >".
                                date_format($end,"H:i")
                                ."</td >
                                <td >".
                                $datas['seats']
                                ."</td >
                            </tr >";
                            }
                            ?>




                            </tbody>
                        </table>

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ajoutDispo">
                            <i class="fas fa-plus"></i> Ajouter une disponibilité
                        </button>
                        <?php }?>


                    </div><!--/tab-pane-->
                    <div class="spacer tab-pane" id="Gardes">

                        <p>Mes gardes</p>

                        <hr>
                        <?php if($_SESSION['active']==0){
                            echo "Votre compte n'a pas encore été validé";
                        }else{?>

                        <table class="table table-hover table-stripped">
                            <thead>
                            <tr>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Début de garde
                                </th>
                                <th>
                                    Fin de garde
                                </th>
                                <th>
                                    Référence
                                </th>
                                <!--<th>
                                    Email client
                                </th>-->
                                <th>
                                    Nom client
                                </th>


                            </tr>


                            </thead>

                            <tbody>

                            <?php





                                foreach ($_SESSION['data5'] as $datas3) {
                                    $date2 = date_create($datas3['date']);
                                    $begin2 = date_create($datas3['begin']);
                                    $end2 = date_create($datas3['end']);
                                    echo "<tr><td>" .
                                        date_format($date2, "d/m/Y")
                                        . "</td>
                                <td>" .
                                        date_format($begin2, "H:i")
                                        . "</td>
                                <td>" .
                                        date_format($end2, "H:i")
                                        . "</td>
                                <td>" .
                                        $datas3['ref']
                                        . "</td>";



                                    foreach ($_SESSION['data6'] as $datas4){
                                        echo "<td>".$datas4['name']."</td>";
                                    }
                                }

                            echo "</tr>";








                            ?>


                            </tbody>
                        </table>
                        <?php }?>


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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="#">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" value="<?php echo $_SESSION['nom'];?>" name="name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $_SESSION['email'];?>" name="email">
                        </div>

                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <textarea class="form-control" rows="1" name="address"><?php echo $_SESSION['address'];?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tel">Téléphone</label>
                            <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"
                                   class="form-control" id="tel" name="phone" value="<?php echo $_SESSION['phone'];?>">
                        </div>

                        <div class="form-group">
                            <label for="siret">N°SIRET</label>
                            <input type="text"
                                   class="form-control" id="siret" value="<?php echo $_SESSION['siret'];?>" name="siret">
                        </div>

                        <div class="form-group">
                            <label for="agrement">N° D'agrément</label>
                            <input type="text"
                                   class="form-control" id="agrement" value="<?php echo $_SESSION['agreement'];?>" name="agreement">
                        </div>


                        <input type="submit" class="btn btn-success" value="Modifier" name="update">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Disponibilité modal -->

    <div class="modal fade" id="ajoutDispo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une disponibilité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="#">

                        <div class="form-group">
                            <label for="mdp">Jour</label>
                            <input  class="form-control" type="date"
                                    value="2018-11-20"
                                    min="2018-11-08" max="2025-12-31" name="date" required/>

                        </div>


                        <div class="form-group">
                            <label for="heureDebut">Heure du début</label>
                            <input class=" form-control spacer" type="time"
                                   min="8:00" max="20:00" name="begin" required>
                        </div>

                        <div class="form-group">
                            <label for="heureFin">Heure de Fin</label>
                            <input class="form-control spacer" type="time"
                                   min="8:00" max="20:00" name="end" required>
                        </div>

                        <div class="form-group">
                            <label for="placesDispo">Places disponibles</label>
                            <input class="form-control spacer" type="text" name="seats">
                        </div>

                        <input type="submit" value="Ajouter" name="addDispo" class="btn btn-success">

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Profil Enfant modal -->





<?php
} else {
    echo 'Veuillez vous connecter';
}
