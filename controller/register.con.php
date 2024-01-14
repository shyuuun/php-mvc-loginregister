<?php 
require_once(__DIR__.'./includes/session-functions.php');
require_once(__DIR__.'./includes/alert-functions.php');

require_once(__DIR__.'./model/register.mod.php');


class RegisterController {

    private $registerModel;

    public function __construct(){
        $this->registerModel = new RegisterModel;
    }

    public function register(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'firstName' => $_POST['register-first-name'],
            'secondName' => $_POST['register-second-name'],
            'email' => $_POST['register-email'],
            'pass' => $_POST['register-pass'],
        ];
        
        // if empty input
        if(empty($data['firstName']) || empty($data['secondName']) || empty($data['email']) || empty($data['pass'])){
            flash('register', 'invalid input', FLASH_WARNING);
            redirect("index.php");
        } 

        // email validation

        if(!filter_var($data['userEmail'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email", FLASH_WARNING);
            redirect("index.php");
        }

        // 
        if(strlen($data['userPass']) < 6){
            flash("register", "Password should be longer than 6");
            redirect("/GraceThesis/register.php");
        }

        // send data to our registermodel
        if($this->registerModel->registerModel($data)){
            echo 'user registered to our system';
        } else {
            echo 'user does not registered to our system due to a certain error';
        }
    }

}


$init = new RegisterController;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $init->register();
}





?>