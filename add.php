<!-- Загрузка фотографий -->

<?php 
    
    if ( isset( $_FILES['photo']['tmp_name'] ) ) {
    
        // Есть новый файл - обработать его
                                                
        $file = basename( $_FILES['photo']['name'] );
        $path = "photos/$file"; 

        if ( ! file_exists( $path ) ) {

            if ( move_uploaded_file( $_FILES['photo']['tmp_name'], $path ) ) {
                
                echo "<p class=\"alert-success p-3\">Файл успешно загружен.</p>";

                $stmt = $mysqli->prepare( "INSERT INTO photos SET file=?, user=?, status=?" );
                $stmt->bind_param( "sss", $file, $_REQUEST['user'], $_REQUEST['status'] );
                $result = $stmt->execute();
        
            } else {
        
                echo "<p class=\"alert-danger p-3\">Ошибка загрузки файла.</p>";
        
            }
        
        } else {
            
            echo "<p class=\"alert-danger p-3\">Такой файл уже существует.</p>";
        
        }

    }
    
    //p($_FILES);

?>



<!-- Форма загрузки -->

<div class="container mt-5 mb-5">
    
    <form method="post" enctype="multipart/form-data">
    
        <div class="form-group row">
            <label for="photo" class="col-sm-2 col-form-label"><h5>Фотография</h5></label>
            <div class="col-sm-10">
                <input type="file" id="photo" name="photo">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="user" class="col-sm-2 col-form-label"><h5>Владелец</h5></label>
            <div class="col-sm-10">
                <input type="text" id="user" name="user">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="caption" class="col-sm-2 col-form-label"><h5>Описание</h5></label>
            <div class="col-sm-10">
                ...
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0"><h5>Доступ</h5></legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_public" value="public" checked>
                        <label class="form-check-label" for="status_public">Открытый</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_private" value="private">
                        <label class="form-check-label" for="status_private">Закрытый</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_draft" value="draft">
                        <label class="form-check-label" for="status_draft">Черновик</label>
                    </div>
                </div>
            </div>
        </fieldset>    
  
        <div class="form-group row mt-5">
            <label for="caption" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button class="btn btn-primary btn-lg" type="submit">Загрузить</button>
            </div>
        </div>

    </form>
    
</div>
