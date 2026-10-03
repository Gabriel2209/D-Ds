<?php

class Conn extends PDO
{
    private $hostDB = "127.0.0.1";
    private $nameDB = "clientes";
    private $userDB = "root";
    private $passDB = "";


    public function __construct(){
        try{
            parent::__construct(
                "mysql:host=". $this->hostDB . 
                ";dbname=" . $this->nameDB . 
                ";", $this->userDB,
                $this->passDB,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            exit;
        }
    }
}


?>