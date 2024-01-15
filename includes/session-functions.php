<?php 


if(!isset($_SESSION)){
    session_start();
}

function userSession($user) {
    $_SESSION['id'] = $user->id;
    $_SESSION["first_name"] = $user->first_name;
    $_SESSION["email"] = $user->email;
    redirect('/../welcome.php');
}

function logout() {
    session_unset();
    session_destroy();
    redirect('/../login.php');
}

function redirect($location){
    header("location: ".$location);
    exit();
}


?>
