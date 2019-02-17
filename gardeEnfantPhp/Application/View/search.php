
<div class="container">
    <div class="row">
        <div class="spacer col-sm-12">
            <p>Résultats de votre recherche</p>
        </div>

       <div class="spacer2 col-sm-12">
            <table class="table table-hover table-stripped">
                <thead>
                <tr>
                    <th>Date disponible</th>
                    <th>De</th>
                    <th>Jusqu'à</th>
                    <th>Nom</th>
                    <th>Place disponible</th>
                    <th>Voir profil</th>

                    <th>Choisir</th>


                </tr>
                </thead>

                <tbody>
                <?php

                foreach ($data as $datas){
                    $date = date_create($datas['date']);
                    $debut = date_create($datas['begin']);
                    $fin = date_create($datas['end']);

                    echo"
    

                <tr>
                    <td>".date_format($date,"d/m/Y")."</td>
                    <td>".date_format($debut,"H:i")."</td>
                    <td>".date_format($fin,"H:i")."</td>";
                    foreach ($data2 as $datas2){
                        echo "<td>".$datas2['name']."</td>";
                    }

                    echo"
                    
                    <td>".$datas['seats']."</td>
                    <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#profilPro'>
                            <i class='fas fa-eye'></i> Voir profil
                        </button>
                    </td>";
                    if($_SESSION['loginUser']!=1){
                        echo"<th><span><a href='".PUB_PATH."/User/login'>Veuillez vous connecter</a> </span></th>";
                    }else {
                    echo"<th><span><a href='#' data-toggle='modal' data-target='#reservation'>Réserver</a> </span></th>";
                    }
                    


                echo "</tr>";
    }?>

                </tbody>


            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="profilPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profil Pro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php

            foreach ($data2 as $datas2){

            echo"
            <div class='modal-body'>
                <div class='text-center'>
                    <img src='".PUB_PATH."/public/img/".$datas2['picture']."' class='avatar img-circle img-thumbnail' alt='avatar'>
                </div></hr><br>

                <div class='row'>
                    <div class='col-sm-12'>
                        <label>Nom : </label> <span>".$datas2['name']."</span>
                    </div>

                </div>

             
                <div class='row'>
                    <div class='col-sm-12'>
                        <label>Email : </label> <span>".$datas2['email']."</span>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-sm-12'>
                        <label>Adresse : </label> <span>".$datas2['address']."</span>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-sm-12'>
                        <label>Téléphone </label> <span>".$datas2['phone']."</span>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col-sm-12'>
                        <label>Prix/Heure :</label> <span>".$datas2['price']."€</span>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-sm-12'>
                        <label>N° SIRET : </label> <span>".$datas2['num_siret']."</span>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-sm-12'>
                        <label>N° Agrément : </label> <span>".$datas2['num_agreement']."</span>
                    </div>
                </div>


            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Fermer</button>

            </div>";
}
            ?>

        </div>
    </div>
</div>

<div class="modal fade" id="reservation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Réservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class='modal-body'>


                <form method="post" action="<?=PUB_PATH?>/Planning/reservation">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <?php foreach ($data as $datas){
                            echo"<input type='date' class='form-control' id='date' value='".$datas['date']."' name='date' readonly>";
                        }


                        ?>


                    </div>

                    <div class="form-group">
                        <label for="debut">Début</label>
                        <?php foreach ($data as $datas){
                            echo"<input type='time' class='form-control' id='debut' value='".$datas['begin']."' name='begin'>";
                        }

                        ?>
                    </div>

                    <div class="form-group">
                        <label for="fin">Fin</label>
                        <?php foreach ($data as $datas){
                            echo"<input type='time' class='form-control' id='fin' value='".$datas['end']."' name='end'>";
                        }

                        ?>
                    </div>

                    <div class="form-group">
                        <label for="enfant">Quel enfant ?</label>
                        <select id='enfant' name="enfant">
                            <option value=''>Veuillez choisir</option>
                        <?php foreach ($data3 as $datas3){
                            echo"
                                
                                <option value='".$datas3['id']."'>".$datas3['firstname']."</option>
                                
                            ";
                        }


                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pro">Etablissement</label>
                        <select id='pro' name="pro">



                            <?php foreach ($data2 as $datas2){
                                echo"
                                
                                <option value='".$datas2['id']."'>".$datas2['name']."</option>
                                
                            ";
                            }


                            ?>


                        </select>
                    </div>



                    <input type="submit" class="btn btn-primary" value="Réserver" name="reserve">
                </form>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Fermer</button>

            </div>


        </div>
    </div>
</div>
</div>




