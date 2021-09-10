<?php

namespace App\Controllers;

use \App\Models\Informations;
use \App\Models\Product;

class CoreController
{
    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewVars Tableau des données à transmettre aux vues
     * @return void
     */
    protected $commonViewVars = [];
    public function __construct($checkACL = true)
    {
        // ---------------------------- //
        // --- User Authorizations --- //
        // -------------------------- //
        global $match;
        $match[ 'name' ];
        if (!$checkACL) {
            return;
        }
        //? tableau de droit d'acces $acl
        $acl = [
            // All users access :
            // 'user-login'=>[],
            // All users logged access :
            'main-home'=>[],
            'user-logout'=>[], // accessible à toute personne AUTHENTIFE
            'product-list'=>[],
            'product-oneProduct'=>[],
            'type-list'=>[],
            // 'product-oneType'=>[],// todo la page n'existe pas encore vraiment
            'product-add'=>[ 'admin' ],
            'product-create'=>[ 'admin' ],
            'product-edit'=>[ 'admin' ],
            'product-update'=>[ 'admin' ],
            'product-delete'=>[ 'admin' ],
            'user-list'=>[ 'admin' ],
            'user-add'=>[ 'admin' ],
            'user-create'=>[ 'admin' ],
            'user-edit'=>[ 'admin' ],
            'user-update'=>[ 'admin' ],
            'user-delete'=>[ 'admin' ],
        ];
        //? $match["name"] me donne le nom de ma route qui est une clé unique
        if (array_key_exists($match[ "name" ], $acl)) {
            $requiredRole = $acl[ $match[ "name" ]];
        } else {
            $requiredRole = [];
        }
        $this->checkAuthorization($requiredRole);
        // ----------------------------------- //
        // --- Elements for Header&Footer --- //
        // --------------------------------- //
        if (isset($_SESSION[ 'appUser' ])) {
            $connectBtn = 'Déconnexion';
            $connectRoute = 'user-logout';
            $userConnected = 'Connecté en tant que ' . $_SESSION[ 'appUser' ]->get('firstname');
        } else {
            $connectBtn = 'Connexion';
            $connectRoute = 'user-login';
            $userConnected = '( Vous n\'êtes pas connecté )';
        };
        $informations = Informations::findOne(1, "tmnt_general_informations", "Informations");
        $this->commonViewVars = [
            'connectBtn' => $connectBtn,
            'connectRoute' => $connectRoute,
            'userConnected' => $userConnected,
            'informations' => $informations,
        ];
    }
    protected function show(string $viewName, $viewVars = [])
    {
        global $router;
        $routeNameTab = explode("-", $router->match()[ 'name' ]);
        $viewVars[ 'pageName' ] = $router->match()[ 'target' ][ 'method' ];
        $viewVars[ 'common' ] = $this->commonViewVars;
        $viewVars[ 'currentView' ] = $viewName;
        $viewVars[ 'assetsBaseUri' ] = $_SERVER[ 'BASE_URI' ] . 'assets/';
        $viewVars[ 'baseUri' ] = $_SERVER[ 'BASE_URI' ];
        $viewVars[ 'pageName' ] = $routeNameTab[ 1 ];
        $viewVars[ 'controllerName' ] = $routeNameTab[ 0 ];
        extract($viewVars);
        extract($common);
        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }
    // CHECK IF A USER IS CONNECTED
    /**
     * @return boolean
     */
    public static function isConnected()
    {
        // IF NO USER LOG
        // dump($_SESSION['appUser']);
        if (!isset($_SESSION[ 'appUser' ])) {
            // VIEW LOGIN PAGE
            global $router;
            header('Location: ' . $router->generate('user-login'));
            exit();
        }
    }
    // CHECK AUHORIZATION OF CONNECTED USER
    /**
     * @param array $requiredRole
     */
    protected function checkAuthorization($requiredRole = [])
    {
        if ($requiredRole == []) {
            return;
        }
        $this->isConnected(); // if user not connected -> out
        $user = $_SESSION[ 'appUser' ];
        $roleUser = $user->get('role'); // getting user's role
        foreach ($requiredRole as $role) {
            if ($roleUser === $role) {
                return true; // user has permissions
            }
        }
        $errorController = new ErrorController(false);
        $errorController->err403();
        exit();
    }
}
