<?php
session_start();
if(!empty($_SESSION["a"])){
    require "connection.php";

    Database::iud("delete from news");
    echo "All Previous news Deleted Successfully";
}

?>