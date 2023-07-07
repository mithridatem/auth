<?php
namespace App\Model;
use App\Utils\BddConnect;
use App\Model\Code;

class Account extends BddConnect{
    /*----------------------------------------
                Attributes
    ----------------------------------------*/
    private ?int $id_account; 
    private ?string $pseudo_account; 
    private ?string $password_account;
    private ?Code $code;
    /*----------------------------------------
                    Construct
    ----------------------------------------*/
    public function __construct(){
        $this->code = new Code();
    }
    /*----------------------------------------
                Getter and Setter
    ----------------------------------------*/
    public function getId():?int{
        return $this->id_account;
    }
    public function getPseudo():?string{
        return $this->pseudo_account;
    }
    public function getPassword():?string{
        return $this->password_account;
    }
    public function getCode():?Code{
        return $this->code;
    }
    public function setId(?int $id):self{
        $this->id_account = $id;
        return $this;
    }
    public function setPseudo(?string $pseudo):self{
        $this->pseudo_account = $pseudo;
        return $this;
    }
    public function setPassword(?string $password):self{
        $this->password_account = $password;
        return $this;
    }
    public function setCode(?Code $code):self{
        $this->code = $code;
        return $this;
    }
    /*----------------------------------------
                    Functions
    ----------------------------------------*/
    public function insertAccount():void{
        $pseudo = $this->pseudo_account;
        $password = $this->password_account;
        $code = $this->getCode()->getId();
        try{
            $req = $this->connexion()->prepare('INSERT INTO account(pseudo_account, password_account, id_code)
            VALUES(?,?,?)');
            $req->bindParam(1, $pseudo, \PDO::PARAM_STR);
            $req->bindParam(2, $password, \PDO::PARAM_STR);
            $req->bindParam(3, $code, \PDO::PARAM_INT);
            $req->execute();
        } 
        catch (\Throwable $th) {
            die('Error : '.$th->getMessage());
        }
    }
    public function getAccountByPseudo():?array{
        $pseudo = $this->getPseudo();
        try{
            $req = $this->connexion()->prepare('SELECT id_account, pseudo_account, password_account, id_code
            FROM account WHERE pseudo_account = ?');
            $req->bindParam(1, $pseudo, \PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetchAll(\PDO::FETCH_ASSOC);
            return $data;
        }
        catch (\Throwable $th) {
            die('Error : '.$th->getMessage());
        }
    }
}
?>