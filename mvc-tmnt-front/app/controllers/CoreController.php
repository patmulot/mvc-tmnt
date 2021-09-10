<?php
    namespace app\controllers;
    use \app\models\Informations;
    use \app\models\Products;
    class CoreController
    {
        protected $commonViewVars = [];
        public function __construct() {
            $informationsModel = new Informations();
            $informations = $informationsModel->findAll();
            $this->commonViewVars['informations'] = $informations;
            
            $productsModel = new Products();
            $products = $productsModel->findAll();
            $this->commonViewVars['products'] = $products;
        }
        public function error404notfound() {
            $this->show("error404notfound");
        }
        function show($viewName, $viewVars=[]) {
            $viewVars['common']= $this->commonViewVars;
            global $router;
            // dump($viewName);
            // dump($viewVars);
            require_once __DIR__ . "/../views/partials/header.tpl.php";
            require_once __DIR__ . "/../views/".$viewName.".tpl.php";
            require_once __DIR__ . "/../views/partials/footer.tpl.php";
        }
    };