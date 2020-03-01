<!-- Страница фотографии -->

<div class="container mb-5">

    <?php
        
        // Подготовить данные для оформления страницы
        
        $status = array(    "private" => "закрытый", 
                            "public" => "открытый", 
                            "draft" => "черновик" );
        
        // Выбрать данные о фотографии

        $result = $mysqli->query( "SELECT * FROM photos WHERE id=$photo" );
        $row = $result->fetch_assoc();

        // p( $row );
    
    ?>


    <div class="row">

        <div class="col col-12 col-md-8 mt-5">
        
            <img src="photos/<?php echo $row['file'] ?>" class="img-fluid">
  
        </div>
      
        <div class="col col-12 col-md-4 mt-5">
        
            <p><strong>Автор:</strong> <?php echo $row['user'] ?>
            <p><?php echo $row['caption'] ?>
            <p><strong>Доступ:</strong> <?php echo $status[$row['status']] ?>

            <p>
            <a href="123" class="btn btn-light text-secondary mt-3" title="Лайк"><i class="fas fa-heart"></i></a>
            <a href="123" class="btn btn-light text-secondary mt-3" title="Репост"><i class="fas fa-share"></i></a>
            <a href="123" class="btn btn-light text-secondary mt-3" title="Комментарий"><i class="fas fa-comment"></i></a>
            
            <p><strong>Комментарии:</strong>
            <p>. . .
            
        </div>
      
    </div>
    
    <div class="row mt-5">
    
        <div class="col">
        
            <strong><a href=".">На главную</a></strong>
        
        </div>    
    
    </div>

</div>

