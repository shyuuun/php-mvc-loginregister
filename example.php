<?php 

session_start();

if(isset($_SESSION['flash_msg']['register'])){
    unset($_SESSION['flash_msg']['register']);
}



echo $_SESSION['flash_msg']['register'];

?>