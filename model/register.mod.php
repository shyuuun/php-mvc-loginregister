<?php 
require(__DIR__.'../dbo.php');

class RegisterModel {
    
    private $dbase;

    public function __construct(){
        $this->dbase = new Database;
    }


    public function registerModel($data) {
        $this->dbase->query('INSERT INTO registered_users (first_name, second_name, email, pass)
        VALUES (:firstName, :secondName, :email, :pass)');

        
        $this->dbase->bind(':firstName', $data['firstName']);
        $this->dbase->bind(':secondName', $data['secondName']);
        $this->dbase->bind(':email', $data['email']);
        $this->dbase->bind(':pass', $data['pass']);
        
        
        if($this->dbase->execute()) {
            echo "values inserted into database";
        } else {
            echo "there is a error while inserteing into database";
        }

    }



}




?>

