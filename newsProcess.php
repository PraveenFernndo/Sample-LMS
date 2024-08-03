<?php
session_start();
if (!empty($_SESSION["a"])) {
    require "connection.php";
    $news = $_POST["news"];

    if(!empty($news)){

;    Database::iud("insert into news (news_description) values ('".$news."')");
    echo "Success";
    }else{
        echo "Please enter news";
    }
}
