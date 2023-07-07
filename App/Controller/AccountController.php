<?php
namespace App\Controller;
use App\Model\Account;
use App\Utils\Fonctions;
class AccountController extends Account{
    /*----------------------------------------
                    Functions
    ----------------------------------------*/
    public function addAccount():void{
        $msg = "";
        if(isset($_POST['submit'])){
            if(!empty($_POST['code'])AND !empty($_POST['pseudo']) AND !empty($_POST['password']) AND !empty($_POST['confirm'])){
                $newCode = Fonctions::cleanInput($_POST['code']);
                $newPseudo = Fonctions::cleanInput($_POST['pseudo']);
                $newPassword = Fonctions::cleanInput($_POST['password']);
                $verify = Fonctions::cleanInput($_POST['confirm']);
                $code = $this->getCode()->getCode();
                //test du password
                if($newPassword == $verify){
                    //test du code
                    if($code[0]['value_code'] == $newCode){
                        $this->getCode()->setId($code[0]['id_code']);
                        $this->setPseudo($newPseudo);
                        $this->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                        $recup = $this->getAccountByPseudo();
                        if(empty($recup)){
                            $this->insertAccount();
                            $msg = "le compte ".$this->getPseudo()." a été ajouté en BDD";
                        }
                        else{
                            $msg = "Le compte existe déja";
                        }
                    }
                    else{
                        $msg ="Le code n'est pas valide";
                    }
                }
                else{
                    $msg = "Les mots de passe ne correspondent pas";
                }
            }
            else{
                $msg = "Veuillez remplir tous les champs du formulaire";
            }
        }
        include 'App/Vue/viewAddAccount.php';
    }
    public function connexionAccount():void{
        $msg = "";
        if(isset($_POST['submit'])){
            if(!empty($_POST['code'])AND !empty($_POST['pseudo']) AND !empty($_POST['password'])){
                $newCode = Fonctions::cleanInput($_POST['code']);
                $newPseudo = Fonctions::cleanInput($_POST['pseudo']);
                $newPassword = Fonctions::cleanInput($_POST['password']);
                $code = $this->getCode()->getCode();
                //test du code
                if($code[0]['value_code'] == $newCode){
                    $this->setPseudo($newPseudo);
                    $recup = $this->getAccountByPseudo();
                    //test si le compte existe
                    if(!empty($recup)){
                        //test du password
                        if(password_verify($newPassword, $recup[0]['password_account'])){
                            $_SESSION['connected']= true;
                            $_SESSION['id']=$recup[0]['id_account'];
                            $_SESSION['pseudo'] = $recup[0]['pseudo_account'];
                            $msg = "Connecté";
                            echo '<script>
                                    setTimeout(()=>{
                                        msg.style.color = "green";
                                        console.log(msg);
                                    }, 100);
                            </script>';
                        }
                        else{
                            $msg = "Les informations email et ou password ne sont pas correctes";
                        }
                    }
                    else{
                        $msg = "Les informations email et ou password ne sont pas correctes";
                    }
                }
                else{
                    $msg ="Le code n'est pas valide";
                }
            }
            else{
                $msg = "Veuillez remplir tous les champs du formulaire";
            }
        }
        include 'App/Vue/viewConnexion.php';
    }
}
?>