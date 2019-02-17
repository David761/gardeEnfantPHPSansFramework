<div class="container">
    <div class="row">

            <?php foreach ($data as $datas){

                echo "<div class='col-sm-4'> <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='".PUB_PATH."/public/img/".$datas['picture']."' alt='Card image cap'>
             <div class='card-body'>
                 <h5 class='card-title'>".$datas['name']."</h5>
                 <ul class='list-group mb-2'>
                     <li class='list-group-item'>Adresse : ".$datas['address']." </li>
                     <li class='list-group-item'>Téléphone : ".$datas['phone']." </li>
                     <li class='list-group-item'>Prix/h : ".$datas['price']."€ </li>
                 </ul>
                 <a href='mailto:".$datas['email']."' class='btn btn-success'>Contacter</a>
             </div>
            </div></div>";
            }?>


    </div>
</div>

