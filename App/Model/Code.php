<?php
namespace App\Model;
use App\Utils\BddConnect;

class Code extends BddConnect{
    /*----------------------------------------
                Attributes
    ----------------------------------------*/
    private ?int $id_code; 
    private ?string $value_code; 
    /*----------------------------------------
                Getter and Setter
    ----------------------------------------*/
    public function getId():?int{
        return $this->id_code;
    }
    public function getValue():?string{
        return $this->value_code;
    }
    public function setId(?int $id):self{
        $this->id_code = $id;
        return $this;
    }
    public function setValue(?string $value):self{
        $this->value_code = $value;
        return $this;
    }
    /*----------------------------------------
                    Functions
    ----------------------------------------*/
    public function insertCode(){
        $code = $this->value_code;
        try{
            $req = $this->connexion()->prepare('INSERT INTO code(value_code) VALUES (?)');
            $req->bindParam(1, $code, \PDO::PARAM_STR);
            $req->execute();
        }
        catch (\Throwable $th) {
            die('Error : '.$th->getMessage());
        }
    }
    public function getCode():?array{
        try
        {
            $req = $this->connexion()->prepare('SELECT id_code,value_code FROM code');
            $req->execute();
            $data = $req->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        }
        catch (\Throwable $th) {
            die('Error : '.$th->getMessage());
        }
    }
}