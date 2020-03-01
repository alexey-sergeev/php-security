<?php

    // Активизировать данные сессии
    
    session_start();

?>

<!doctype html>
<html lang="ru">
    <head>

        <!-- Подключить Bootstrap для оформления страницы -->

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Font Awesome - векторные иконки -->

        <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
        
        <!-- Локальные настройки сайта -->

        <link rel="stylesheet" href="styles.css">
        <link rel="icon" href="interface/logo-o.png">

        <title>Фотографии</title>

    </head>
    <body>

        <?php

            // Вспомогательные функции

            require_once "functions.php";

            // Подключение к MySQL

            $mysqli = new mysqli( "localhost", "photosite", "photositepwd", "photosite" );
            
            if ( $mysqli->connect_errno ) {

                echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                die();

            }
            
            $mysqli->set_charset( "utf8" );

            // Определить идентификаторы запрашиваемых страниц

            global $photo;
            $photo = ( isset( $_REQUEST['photo'] ) ) ? (int) $_REQUEST['photo'] : false;

            global $add;
            $add = ( isset( $_REQUEST['add'] ) ) ? true : false;

            global $user;
            $user = ( isset( $_REQUEST['user'] ) ) ? $mysqli->escape_string( $_REQUEST['user'] ) : false;

            // p( $_REQUEST );

        ?>


        <!-- Заголовок -->

        <?php include "header.php"; ?>


        <!-- Основное содержимое -->

        <?php 
        
            if ( $photo ) {

                include "photo.php"; 

            } elseif ( $add ) {
            
                include "add.php"; 
            
            } else {

                include "homepage.php"; 

            }
        
        ?>

        <!-- Нижняя часть страницы -->

        <?php include "footer.php"; ?>

        <!-- Отключение от MySQL -->

        <?php 

            $mysqli->close();

        ?>

    </body>
</html>