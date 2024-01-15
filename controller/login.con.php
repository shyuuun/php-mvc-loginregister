<?php 
require_once __DIR__.'/../includes/session-functions.php';
require_once __DIR__.'/../includes/alert-functions.php';
require_once __DIR__.'/../model/login.mod.php';


class LoginController { 
    private $loginModel;

    public function __construct() { 
        $this->loginModel = new LoginModel();
    }

    public function login(){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [ 
            'email' => $_POST['login-email'],
            'pass' => $_POST['login-pass']
        ];

        


        if(empty($data['email']) || empty($data['pass'])) {
            flash('login', 'Please input all fields', FLASH_INFO);
            redirect('/../login.php');
        }

        if($this->loginModel->checkUserExist($data['email'])) {
            $loginUser = $this->loginModel->login($data['email'], $data['pass']);

            if($loginUser) {
                userSession($loginUser);
            } else {
                flash ('login', 'Pass incorrect', FLASH_WARNING);
                redirect('/../login.php');
            }
        } 
        
    }
}

$init = new LoginController();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $init->login();
}


?>