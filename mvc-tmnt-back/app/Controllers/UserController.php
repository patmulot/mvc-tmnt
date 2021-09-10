<?php

namespace App\Controllers;

use App\Models\User;
use \App\Models\INFORMATION_SCHEMA;

class UserController extends CoreController
{
    private $tableFromDb = "app_user";
    private $model = "User";
    // =================== //
    // === CONNECTION === //
    // ================= //
    /**
     * Affichage du formulaire de connexion
     */
    public function login()
    {
        $this->show('user/login');
    }
    public function connect()
    {
        $currentMessage=[];
        // dump($_POST); //!
        // get email and password from POST with filters
        $formEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $formPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        // ------------------ //
        // --- USER MAIL --- //
        // ---------------- //
        // #1
        // check if if email is empty
        if (empty($formEmail)) {
            // show login page
            $currentMessage["message"] = "email invalid (empty)"; //! temporaire
            $this->show('user/login', $currentMessage);
            exit();
        }
        // #2
        // getting back user object if email match in db
        $userToCheck = User::findByEmail($formEmail);
        if ($userToCheck === false) {
            $currentMessage["message"] = "email invalid (dont match)";
            $this->show('user/login', $currentMessage);
            exit();
        }
        // then user OK to connect :
        $userToConnect = $userToCheck;
        // ---------------------- //
        // --- USER PASSWORD --- //
        // -------------------- //
        // #1
        // getting user's password from db:
        $dbPasswordHashed = $userToConnect->get('password');
        // dump(password_hash($dbPasswordNOTHashed, PASSWORD_DEFAULT));
        // #2
        // check if password from post match with user's password
        if (password_verify($formPassword, $dbPasswordHashed)) {
            $currentMessage["message"] = "Bienvenue ".$userToConnect->get('firstname')." ".$userToConnect->get('lastname');
            // userToConnect dans tableau SESSION
            $_SESSION['appUser'] = $userToConnect;
            echo 'session started';
        // $this->show('user/userList', $currentMessage);
        } else {
            $currentMessage["message"] = "hin hin hin... vous n'avez pas dit le mot magique... hin hin hin...";
            // $this->show( 'user/login', $currentMessage );
        };
        $this->show('user/connect', $currentMessage);
    }
    public function logout()
    {
        global $router;
        // End of session -> login page
        unset($_SESSION['appUser']);
        $currentMessage["message"] = "Vous êtes deconnecté";
        echo 'session unsetted';
        $homepageUrl = $router->generate('user-login', $currentMessage);
        header('Location: ' . $homepageUrl);
    }
    // ============= //
    // === SHOW === //
    // =========== //
    // show all :
    /**
     * view list
     */
    public function list()
    {
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $userList = User::findAll($this->tableFromDb);
        $this->show('global/list', [
            'currentColumn' => $columns,
            'currentPage' => $userList,
        ]);
    }
    // ============ //
    // === NEW === //
    // ========== //
    /**
     * view form to add new
     */
    public function add()
    {
        $userModel = new User();
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
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
                $optionsString = substr($columnType, 5, -1);
                $optionsTabString = explode(",", $optionsString);
                $optionsTab[$columnName] = str_replace("'", "", $optionsTabString);
            } else {
                $currentType[] = 'text';
                $formItem[] = 'input';
            };
        }
        $this->show('global/add', [
            'currentColumn' => $columns,
            'currentType' => $currentType,
            'formItem' => $formItem,
            'optionsTab' => $optionsTab,
            'formAction' => 'create',
            ]);
    }
    /**
     * add new to db from form
     */
    public function create()
    {
        $newUser = new User();
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($columns); $i++) {
            $var = $columns[$i]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at" && $var != "id") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $newUser->set($var, $varFromFormHash);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $newUser->set($var, $varFromForm);
                };
            };
        }
        $newUser->insert();
        global $router;
        header('Location: '. $router->generate('user-list'));
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
        // getting user to edit
        $userToModify = User::findOne($id, $this->tableFromDb, $this->model);
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
                $optionsString = substr($columnType, 5, -1);
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
            'optionsTab' => $optionsTab,
            'currentPage' => $userToModify,
            'oldPassword' => $oldPassword,
            'formAction' => 'update',
            ]);
    }
    public function update($id)
    {
        $userToModify = User::findOne($id, $this->tableFromDb, $this->model); // getting user to modify
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        for ($i = 0; $i < count($columns); $i++) {
            $var = $columns[$i]->COLUMN_NAME;
            if ($var != "updated_ad" && $var != "created_at") {
                if ($var === "password") {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $varFromFormHash = password_hash($varFromForm, PASSWORD_DEFAULT);
                    $userToModify->set($var, $varFromFormHash);
                } elseif ($var === "id") {
                    $userToModify->set($var, $id);
                } else {
                    $varFromForm = filter_input(INPUT_POST, $var, FILTER_SANITIZE_STRING);
                    $userToModify->set($var, $varFromForm);
                };
            };
        }
        // update user :
        $userToModify->update();
        global $router;
        header('Location: '. $router->generate('user-list'));
    }
    // =============== //
    // === REMOVE === //
    // ============= //
    public function delete($id)
    {
        $UserToRemove = User::findOne($id, $this->tableFromDb, $this->model);
        $UserToRemove->delete($id, $this->tableFromDb);
        global $router;
        header('Location: '. $router->generate('user-list'));
    }
}
