<?php
    //utilisation de session_start(pour gérer la connexion au serveur)
    session_start();
    use App\Controller\CodeController;
    use App\Controller\AccountController;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Code.php';
    include './App/Model/Account.php';
    include './App/Controller/CodeController.php';
    include './App/Controller/AccountController.php';
    $codeCtrl = new CodeController();
    $accountCtrl = new AccountController();
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //routeur
    switch ($path) {
        case '/auth/':
            include './home.php';
            break;
        case '/auth/account':
            $accountCtrl->addAccount();
            break;
        case '/auth/connexion':
            $accountCtrl->connexionAccount();
            break;
        case '/auth/test':
            include './test.php';
            break;
        default:
            include './error.php';
            break;
    }
?>
