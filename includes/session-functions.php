<?php 


if(!isset($_SESSION)){
    session_start();
}


function redirect($location){
    header("location: ".__DIR__.$location);
    exit();
}


?>
