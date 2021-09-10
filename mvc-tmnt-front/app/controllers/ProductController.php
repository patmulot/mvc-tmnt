<?php
    namespace app\controllers;
    use \app\models\Products;
    use \app\models\Type;
    class ProductController extends CoreController
    {
        public function allProduct () {
            $products1Model = new Products();
            $products1 = $products1Model->findAll();
            $typeModel = new Type();
            $type = $typeModel->findAll();
            $viewVars = [
                'products1' => $products1,
                'type' => $type,
            ];
            $this->show( "allProduct", $viewVars );
        }
        public function oneProduct($routeVarInfos) {
            $productsModel = new Products();
            $oneProducts = $productsModel->findOne( $routeVarInfos['id'] );
            $oneTypeModel = new Type();
            $oneType = $oneTypeModel->findOne( $routeVarInfos['id'] );
            $viewVars = [
                'oneProducts' => $oneProducts,
                'oneType' => $oneType,
            ];
            // dump($viewVars);
            $this->show( "oneProduct", $viewVars  );
        }
    };