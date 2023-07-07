<?php
namespace App\Controller;
use App\Model\Code;
use App\Utils\Fonctions;
class CodeController extends Code{
    /*----------------------------------------
                    Functions
    ----------------------------------------*/
    public function addCode(){
        $msg = "";
        if(isset($_POST['submit'])){
            if(!empty($_POST['code'])){
                $newCode = Fonctions::cleanInput($_POST['code']);
                $this->setValue($newCode);
                $this->insertCode();
                $msg = "Le code à été ajouté en BDD";
            }
            else{
                $msg = "Veuillez choisir un code";
            }
        }
        include 'App/Vue/viewAddCode.php';
    }
}
?>