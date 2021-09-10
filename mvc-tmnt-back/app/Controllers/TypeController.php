<?php
    namespace App\Controllers;

    use \App\Models\Type;
    use \App\Models\INFORMATION_SCHEMA;

class TypeController extends CoreController
{
    private $tableFromDb = "type";
    private $model = "Type";
    public function list()
    {
        $typesModel = new Type();
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $types = $typesModel->findAll($this->tableFromDb);
        $this->show("global/list", [
            'currentColumn' => $columns,
            'currentPage' => $types,
        ]);
    }
    // ============ //
    // === NEW === //
    // ========== //
    public function add()
    {
        $typesModel = new Type();
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($columns); $i++) {
            if ($columns[ $i ]->DATA_TYPE === 'int') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($columns[ $i ]->DATA_TYPE === 'tinyint') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($columns[ $i ]->DATA_TYPE === 'varchar') {
                $currentType[] = 'text';
                $formItem[] = 'input';
            } elseif ($columns[ $i ]->DATA_TYPE === 'enum') {
                $currentType[] = 'text';
                $formItem[] = 'select';
                // getting tab from db enum string :
                $columnType = $columns[ $i ]->COLUMN_TYPE;
                $columnName = $columns[ $i ]->COLUMN_NAME;
                $optionsString = substr($columnType, 5, -1);
                $optionsTabString = explode(",", $optionsString);
                $optionsTab[$columnName] = str_replace("'", "", $optionsTabString);
            } else {
                $currentType[] = 'text';
                $formItem[] = 'input';
            };
        }
        $this->show("global/add", [
            'currentColumn' => $columns,
            'currentType' => $currentType,
            'formItem' => $formItem,
            'formAction' => 'create',
        ]);
    }
    public function create()
    {
        $newType = new Type();
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($columns); $i++) {
            $var = $columns[ $i ]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at" && $var != "id") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $newType->set($var, $varFromFormHash);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $newType->set($var, $varFromForm);
                };
            };
        }
        $newType->insert();
        global $router;
        header('Location: '. $router->generate('type-list'));
    }
    // =============== //
    // === MODIFY === //
    // ============= //
    /**
     * view form to edit one
     */
    public function edit($id)
    {
        // getting cell names for view
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        // getting Type to edit
        $typeToModify = Type::findOne($id, $this->tableFromDb, $this->model);
        // getting inputs to use in form from view
        $currentType = [];
        for ($i = 0; $i < count($columns); $i++) {
            if ($columns[$i]->DATA_TYPE === 'int') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($columns[$i]->DATA_TYPE === 'tinyint') {
                $currentType[] = 'number';
                $formItem[] = 'input';
            } elseif ($columns[$i]->DATA_TYPE === 'varchar') {
                $currentType[] = 'text';
                $formItem[] = 'input';
            } elseif ($columns[$i]->DATA_TYPE === 'enum') {
                $currentType[] = 'text';
                $formItem[] = 'select';
                // getting tab from db enum string :
                $columnType = $columns[$i]->COLUMN_TYPE;
                $columnName = $columns[$i]->COLUMN_NAME;
                $optionsString = substr($columns, 5, -1);
                $optionsTabString = explode(",", $optionsString);
                $optionsTab[$columnName] = str_replace("'", "", $optionsTabString);
            } else {
                $currentType[] = 'text';
                $formItem[] = 'input';
            };
            if ($columns[$i]->COLUMN_NAME === "password") {
                $oldPassword = 'Enter password';
            }
        }
        // show form view
        $this->show('global/add', [
            'currentColumn' => $columns,
            'currentType' => $currentType,
            'formItem' => $formItem,
            'currentPage' => $typeToModify,
            'formAction' => 'update',
            ]);
    }
    public function update($id)
    {
        $typeToModify = Type::findOne($id, $this->tableFromDb, $this->model); // getting user to modify
        $columnUser = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($columnUser); $i++) {
            $var = $columnUser[$i]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $typeToModify->set($var, $varFromFormHash);
                } elseif ($var === "id") {
                    $typeToModify->set($var, $id);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $typeToModify->set($var, $varFromForm);
                };
            };
        }
        // update user :
        $typeToModify->update();
        global $router;
        header('Location: '. $router->generate('type-list'));
    }
    // =============== //
    // === REMOVE === //
    // ============= //
    public function delete($id)
    {
        $typeToRemove = INFORMATION_SCHEMA::findOne($id, $this->tableFromDb, $this->model);
        $typeToRemove->delete($id, $this->tableFromDb);
        global $router;
        header('Location: '. $router->generate('type-list'));
    }
};
