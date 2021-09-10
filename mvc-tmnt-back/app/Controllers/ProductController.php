<?php
    namespace App\Controllers;

    use \App\Models\Product;
    use \App\Models\INFORMATION_SCHEMA;

class ProductController extends CoreController
{
    private $tableFromDb = "products";
    private $model = "Product";
    // ============= //
    // === SHOW === //
    // =========== //
    // show all :
    public function list()
    {
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $products = Product::findAll($this->tableFromDb);
        $this->show("global/list", [
            'currentColumn' => $Columns,
            'currentPage' => $products,
        ]);
    }
    // show one :
    public function oneProduct($routeVarInfos)
    {
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $product = Product::findOne($routeVarInfos);

        $this->show("product/oneProduct", [
            'currentColumn' => $Columns,
            'currentPage' => $product,
                ]);
    }
    // ============ //
    // === NEW === //
    // ========== //
    public function add()
    {
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($Columns); $i++) {
            if ($Columns[ $i ]->DATA_TYPE === 'int') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'tinyint') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'varchar') {
                $currentType[] = 'text';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'enum') {
                $currentType[] = 'text';
                $formItem[] = 'select';
                // getting tab from db enum string :
                $columnType = $Columns[ $i ]->COLUMN_TYPE;
                $columnName = $Columns[ $i ]->COLUMN_NAME;
                $optionsString = substr($columnType, 5, -1);
                $optionsTabString = explode(",", $optionsString);
                $optionsTab[ $columnName ] = str_replace("'", "", $optionsTabString);
            } else {
                $currentType[] = 'text';
                $formItem[] = 'input';
            };
        }
        $this->show("global/add", [
            'currentColumn' => $Columns,
            'currentType' => $currentType,
            'formItem' => $formItem,
            'formAction' => 'create',
        ]);
    }
    public function create()
    {
        $newProduct = new Product();
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($Columns); $i++) {
            $var = $Columns[ $i ]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at" && $var != "id") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $newProduct->set($var, $varFromFormHash);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $newProduct->set($var, $varFromForm);
                };
            };
        }
        $newProduct->insert();
        global $router;
        header('Location: '. $router->generate('product-list'));
    }
    // =============== //
    // === MODIFY === //
    // ============= //
    public function edit($id)
    {
        // getting cell names for view
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        // getting user to edit
        $productToModify = Product::findOne($id, $this->tableFromDb, $this->model);
        // getting inputs to use in form from view
        $currentType = [];
        for ($i = 0; $i < count($Columns); $i++) {
            if ($Columns[ $i ]->DATA_TYPE === 'int') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'tinyint') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'varchar') {
                $currentType[] = 'text';
                $formItem[] = 'input';
            } elseif ($Columns[ $i ]->DATA_TYPE === 'enum') {
                $currentType[] = 'text';
                $formItem[] = 'select';
                // getting tab from db enum string :
                $columnType = $Columns[ $i ]->COLUMN_TYPE;
                $columnName = $Columns[ $i ]->COLUMN_NAME;
                $optionsString = substr($columnType, 5, -1);
                $optionsTabString = explode(",", $optionsString);
                $optionsTab[ $columnName ] = str_replace("'", "", $optionsTabString);
            } else {
                $currentType[] = 'text';
                $formItem[] = 'input';
            };
            if ($Columns[ $i ]->COLUMN_NAME === "password") {
                $oldPassword = 'Enter password';
            }
        }
        // show form view
        $this->show('global/add', [
            'currentColumn' => $Columns,
            'currentType' => $currentType,
            'formItem' => $formItem,
            'currentPage' => $productToModify,
            'formAction' => 'update',
            ]);
    }
    public function update($id)
    {
        $productToModify = Product::findOne($id, $this->tableFromDb, $this->model); // getting user to modify
        $Columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($Columns); $i++) {
            $var = $Columns[ $i ]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $productToModify->set($var, $varFromFormHash);
                } elseif ($var === "id") {
                    $productToModify->set($var, $id);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $productToModify->set($var, $varFromForm);
                };
            };
        }
        // update user :
        $productToModify->update();
        global $router;
        header('Location: '. $router->generate('product-list'));
    }
    // =============== //
    // === REMOVE === //
    // ============= //
    public function delete($id)
    {
        $productToRemove = Product::findOne($id, $this->tableFromDb, $this->model);
        $productToRemove->delete($id, $this->tableFromDb);
        global $router;
        header('Location: '. $router->generate('product-list'));
    }
};
