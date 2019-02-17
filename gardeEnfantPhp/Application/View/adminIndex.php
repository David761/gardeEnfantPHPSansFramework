<?php
if($_SESSION['Admin']==1){
    ?>
    <div class="container">
        <div class="row">
            <div class="spacer col-sm-12">
                <p> <h3>Les Professionnels </h3></p>
            </div>

            <div class="spacer2 col-sm-12">
                <table class="table table-hover table-stripped">
                    <thead>
                    <tr>

                        <th>Nom</th>
                        <th>Siret</th>
                        <th>Aggrément</th>
                        <th>Email</th>
                        <th>Activation</th>

                        <th>Supprimer</th>

                    </tr>
                    </thead>

                    <tbody>

                        <?php
                            foreach ($data as $datas){
                                echo "<tr><td>".$datas['name']."</td>
                        <td>".$datas['num_siret']."
                        </td>
                        <td>".$datas['num_agreement']."</td>
                        <td>".$datas['email']."</td>";
                                if ($datas['active']!=1){
                                    echo "<td><a href='".PUB_PATH."/Admin/activation'>Activer</a></td>";
                                }else {
                                    echo "<td>Déjà activé</td>";
                                }

                                echo "<td><a href='".PUB_PATH."/Admin/suppression'>Supprimer</a> </td>";

                            }
                        ?>




                    </tbody>


                </table>
            </div>
        </div>
    </div>







    <?php

}else {
    echo "Acces refusé";
}