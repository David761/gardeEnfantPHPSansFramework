<?php
session_start();
date_default_timezone_set('Europe/Paris');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="<?= PUB_PATH?>/public/css<?= DIRSEP;?>style.css" media="screen,projection"/>





    <link rel="shortcut icon" href="<?= PUB_PATH?>/public/img/tetine.png"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>ChildCare</title>

</head>
<body>
<div class="sm">
    <img class="img-fluid sm" src="<?= PUB_PATH?>/public/img/bannierenuageinversée.png" id="nuage">



    <div class="container-fluid spacer sm">

        <!-- Logo -->
        <div class="row sm">

            <div class="col-sm-3 sm">


                <a href="<?= PUB_PATH?>"><img class="img-fluid rounded mx-auto d-block sm" alt="childcare" src="<?= PUB_PATH?>/public/img<?= DIRSEP;?>bonlogo.png"></a>

            </div>


            <!-- Recherche date/calendrier/horraire -->


            <div class="col-sm-6 sm">

                <div class="row sm">

                    <div class="col-sm" id="animate">
                        <h3 class="">Vous Recherchez</h3>
                    </div>

                </div>

                <div class="row sm">



                    <div class="recherche col sm">
                        <form method="post" action="<?= PUB_PATH?>/Planning/recherche">

                            <label class="labelRecherche" >Le : </label>
                            <input class="calendrier sm" type="date"
                               value=""
                               min="2018-11-08" max="2025-12-31" name="date" required/>

                            <label class="labelRecherche sm">De : </label>

                            <input class="horraire sm" type="time"
                               value="08:00"
                               min="8:00" max="20:00" name="debut" required>


                        <!-- <span class="glyphicon glyphicon-calendar"></span>-->

                            <label class="labelRecherche sm">&Agrave; : </label>
                            <input class="horraire sm" type="time"
                               value="18:00"
                               min="9:00" max="20:00" name="fin" required>

                            <input type="submit" class="btn btn-success" name="search" value="Rechercher">

                        </form>

                    </div>




                </div>



            </div>


            <!-- Connexion/Inscription -->

            <div class="col-sm-3 sm">


                <div class="nav nav-pills spacer1 sm">

                    <?php if($_SESSION['login']!=1 && $_SESSION['loginUser']!=1) { ?>
                        <li class="nav-item dropdown responsive-sm-4 mr-1">
                            <a class="btn btn- btn-sm dropdown-toggle responsive-sm-4 btn-success" data-toggle="dropdown" href="#">
                                <span class="Inscription">Connexion</span>
                            </a>
                            <div class="dropdown-menu responsive-sm-4">
                                <a class="dropdownLien dropdown-item responsive-sm-4"
                                   href="<?= PUB_PATH ?>/Professionnels/login">Professionnels</a>
                                <a class="dropdownLien dropdown-item responsive-sm-4" href="<?= PUB_PATH ?>/User/login">Parents</a>
                            </div>
                        </li>


                        <li class="nav-item dropdown responsive-sm-4">
                            <a class="btn btn- btn-sm dropdown-toggle responsive-sm-4 btn-success" data-toggle="dropdown" href="#">
                                <span class="Inscription">Inscription</span>
                            </a>
                            <div class="dropdown-menu responsive-sm-4">
                                <a class="dropdownLien dropdown-item responsive-sm-4"
                                   href="<?= PUB_PATH ?>/Professionnels/inscription">Professionnels</a>
                                <a class="dropdownLien dropdown-item responsive-sm-4"
                                   href="<?= PUB_PATH ?>/User/inscription">Parents</a>
                            </div>
                        </li>

                        <?php
                    }
                    if($_SESSION['loginPro']==1){
                        echo "<li class='nav-item responsive-sm-4'>
                        <a class='btn btn- btn-sm responsive-sm-4 btn-success mr-1' href='".PUB_PATH."/Professionnels/profil' >
                            <span class='Inscription'>Profil</span>
                        </a>
         
                    </li>
                    <li class='nav-item responsive-sm-4'>
                        <a class='btn btn- btn-sm responsive-sm-4 btn-danger' href='".PUB_PATH."/Professionnels/logout' >
                            <span class='Inscription'>Déconnexion</span>
                        </a>
         
                    </li>";
                    }elseif ($_SESSION['loginUser']==1){
                        echo "<li class='nav-item responsive-sm-4'>
                        <a class='btn btn- btn-sm responsive-sm-4 btn-success mr-1' href='".PUB_PATH."/User/profil' >
                            <span class='Inscription'>Profil</span>
                        </a>
         
                    </li>
                    <li class='nav-item responsive-sm-4'>
                        <a class='btn btn- btn-sm responsive-sm-4 btn-danger mr-1' href='".PUB_PATH."/Professionnels/logout' >
                            <span class='Inscription'>Déconnexion</span>
                        </a>
         
                    </li>";
                    }
                    if ($_SESSION['Admin']==1){
                        echo "<li class='nav-item responsive-sm-4'>
                        <a class='btn btn- btn-sm responsive-sm-4 btn-info' href='".PUB_PATH."/Admin/index' >
                            <span class='Inscription'>Page admin</span>
                        </a>
         
                    </li>";
                    }
                    ?>

                </div>


                </ul>

                <div class="background sm">
                    <img class="img-fluid" alt="childcare" src="<?= PUB_PATH?>/public/img<?= DIRSEP;?>bonhommeanime.gif">

                </div>

            </div>

        </div>

    </div>
</div>





