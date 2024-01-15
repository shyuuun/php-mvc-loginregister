<?php 
require __DIR__.'/../dbo.php';

class UserModel { 

    protected $dbase;
    
    public function __construct() {
        $this->dbase = new Database();
    }


    public function checkUserExist($email) {
        $this->dbase->query('SELECT * FROM registered_users WHERE email = :email');
        $this->dbase->bind(':email', $email);

        $row = $this->dbase->single();

        if($this->dbase->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

}

?>