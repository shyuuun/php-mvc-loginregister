<?php

class Database {

    // enter your database details here
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $databaseName = "login_example";

    

    private $stmt;
    private $dbh;
    private $error;
    
    public function __construct(){

        $dsn = 'mysql:host='.$this->host.';dbname='.$this->databaseName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // create PDO instance

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }

    // automatically bind values to prepare statements

    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_BOOL;
                    break; 
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }


    // we can place our query here
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // executes our statement here
    public function execute() {
        return $this->stmt->execute();
    }

    // return multiple records
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // return single records
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }


}



?>