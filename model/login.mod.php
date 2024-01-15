<?php 
require __DIR__.'/UserModel.php';


class LoginModel extends UserModel {

    public function __construct(){ parent::__construct(); }

    public function login($email, $pass) {
        $row = parent::checkUserExist($email);
        
        if($row == false) return false; 

        $hashpass = $row->pass;
        if(password_verify($pass, $hashpass)){

            return $row;
        } else { 
            return false; 
        }
        
    }


}

?>