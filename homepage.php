<!-- Главная страница -->

<!-- Поисковая строка -->

<div class="row justify-content-center bg-secondary">
    <div class="col-md-8 text-white text-center">

        <h4 class="m-4">Что хотите найти?</h4>

        <div class="input-group mt-4 mb-5">
            <input class="form-control form-control-lg" type="text" placeholder="два друга и собака">
            <div class="input-group-append">
                <button class="btn btn-light" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
        </div>


    </div>
</div>


      
<!-- Авторы сайта -->

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-4 text-center m-4">

            <h4 class="border-bottom pb-3 mb-4">Наши авторы</h4>

        </div>

    <div>
    
    <div class="row justify-content-center pb-5">
    
        <?php
            
            // Выбрать данные о пользователях
    
            $result = $mysqli->query( "SELECT * FROM users" );
        
            while ( $row = $result->fetch_assoc() ) :
    
                // p( $row );
        
        ?>

        <div class="card col-2 ml-3 mr-3 p-3">
            <a href="?user=<?php echo $row['login'] ?>">
              <img src="avatars/<?php echo $row['avatar'] ?>" class="card-img-top">
              <div class="card-body"> 
                  <h5 class="card-title text-center m-0"><?php echo $row['name'] ?></h5>
              </div>
            </a>
        </div>

        <?php
        
            endwhile;
        
        ?>
 
    </div>

</div>

<!-- Коллекция фотографий -->

<div class="container-fluid">

    <div class="row justify-content-center bg-light">

        <div class="col-md-4 text-center m-4">

            <h4 class="border-bottom pb-3 mb-4">Коллекция фотографий</h4>
            <p><a href="?add=yes" class="btn btn-primary btn-lg">Загрузить</a></p>

        </div>

    </div>

</div>

<div class="container mb-5">

    <div class="row justify-content-center">

        <?php

            if ( $user ) {
            
                $title = "Пользователь: <span class=\"bg-light p-2 pl-3 pr-3\">$user<span>";
            
            } else {
            
                $title = "Все фотографии";
            
            }

        ?>

       <h4 class="m-5"><?php echo $title ?></h4>

    </div>

    <div class="card-columns">

        <?php
            
            // Подготовить данные для оформления карточек
            
            $arr_stat = array(  "private" => "Закрытый доступ", 
                                "public" => "Открытый доступ", 
                                "draft" => "Черновик" );
            
            $arr_ico = array(   "private" => "fas fa-key", 
                                "public" => "fas fa-eye", 
                                "draft" => "fas fa-edit" );
            
            // Выбрать данные о фотографиях

            if ( $user ) {

                // Если запрошены фотографии только конкретного пользователя

                $sql = "SELECT * FROM photos WHERE user='$user'";
                
            } else {
            
                // Если запрошены фотографии всех пользователей

                $sql = "SELECT * FROM photos";
            
            }
            
    
            $result = $mysqli->query( $sql );
        
            while ( $row = $result->fetch_assoc() ) :

                // p( $row );

                // Подготовить переменные для оформления коллекции

                $id = $row['id'];
                $user = $row['user'];
                $status = $arr_stat[$row['status']];
                $ico = $arr_ico[$row['status']];
                
                if ( $row['status'] == 'private' ) {

                    $photo = "interface/close.png";

                } else {

                    $photo = "photos/" . $row['file'];

                }

        ?>

        <div class="card">
            <a href="?photo=<?php echo $id ?>"><img src="<?php echo $photo ?>" class="card-img-top"></a>
            <div class="card-img-overlay bg-light p-2" style="top: auto; right: auto; opacity: 0.8">
                <i class="fas fa-user mr-2"></i><?php echo $user ?>
                <i class="<?php echo $ico ?> ml-2 mr-2"></i><?php echo $status ?>
            </div>
        </div>

        <?php
        
            endwhile;
        
        ?>

    </div>
    
</div>
