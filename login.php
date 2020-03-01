<!-- Форма входа на сайт -->

<!-- Примечание. Пароли в базе данных зашифрованы алгоритмом md5 -->

<?php

    if ( isset( $_REQUEST['login'] ) ) {
    
        // Получен запрос для входа на сайт
    
        $login = $mysqli->escape_string( $_REQUEST['login'] );
        
        // Получить данные запрошенного пользователя
        
        $result = $mysqli->query( "SELECT * FROM users WHERE login='$login'" );
        
        if ( $result->num_rows ) {
        
            // Пользователь нашелся
            
            $_SESSION['current_user'] = $login;
        
        } else {
        
            // Пользователь не нашелся
            
            echo "<p class=\"alert-danger p-3\">Вы ошиблись. Попробуйте еще раз.</p>";                          
        
        }
    
    } elseif ( isset( $_REQUEST['logout'] ) ) {

        session_unset();
        session_destroy();
    
    }

?>

<?php

    if ( isset( $_SESSION['current_user'] ) ) :
    
        // Пользователь авторизован

        $current_user = $_SESSION['current_user']; 
        $result = $mysqli->query( "SELECT * FROM users WHERE login='$current_user'" );
        $row = $result->fetch_assoc();

?>
          
<div class="media">
    <img src="avatars/<?php echo $row['avatar'] ?>" class="border" style="width: 75px;">
    <div class="media-body pl-4">
        <p>Вы: <?php echo $row['name'] ?><br />
        <a href="?logout=yes">Выйти</a>
    </div>
</div>

<?php 

    else :
    
        // Пользователь не авторизован

?>

<p>Войти на сайт:

<form method="post" action=".">

    <p><input type="text" name="login" placeholder="логин" class="p-2">
    <p>...
    <p><button class="btn btn-light pl-3 pr-3 pt-2 pb-2" type="submit">Войти</button>

</form>

<?php 

    endif;

?>
