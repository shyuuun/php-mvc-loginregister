<?php 
require_once __DIR__.'/../includes/session-functions.php';
require_once __DIR__.'/../includes/alert-functions.php';
require_once __DIR__.'/../model/register.mod.php';


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
            redirect('/../index.php');
        }

        // email validation
        if($this->registerModel->checkUserExist($data['email'])){
            flash("register", "Email is already taken", FLASH_WARNING);
            redirect('/../index.php');
        }
        // password hashing 

        $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

        

        // send data to our registermodel
        if($this->registerModel->registerModel($data)){
            flash('register', 'user adding to database', FLASH_INFO);
            redirect('/../index.php');
        } else {
            flash('register', 'There is a error adding this user into database', FLASH_ERROR);
            redirect('/../index.php');
        }
    }

}


$init = new RegisterController;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $init->register();
}





?>