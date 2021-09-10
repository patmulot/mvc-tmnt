<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

class User extends CoreModels
{
    private $tableFromDb = "app_user";
    private $email;
    private $password;
    protected $firstname;
    private $lastname;
    private $role;
    private $status;
    public static function findByEmail($email)
    {
        $pdo = Database::getPDO();
        //? attention aux emojis :email: :D
        $sql = 'SELECT * FROM `app_user` WHERE `email` = :email';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
        $mailChecked = $pdoStatement->execute();
        if ($mailChecked) {
            $userToConnect = $pdoStatement->fetchObject('App\Models\User');
            return $userToConnect;
        } else {
            return false;
        }
    }
    // insert new element in DB :
    public function insert()
    {
        $columnUser = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $pdo = Database::getPDO();
        for ($i = 0; $i < count($columnUser); $i++) {
            $columnName = $columnUser[$i]->COLUMN_NAME;
            if ($columnName != "updated_at" && $columnName != "created_at" && $columnName != "id") {
                $colNameTab[] = "`" . $columnName . "`";
                $valueNameTab[] = $this->get($columnName);
                $newValueTab [] = ':' . $columnName;
                $colTypeTab [] = $columnUser[$i]->DATA_TYPE;
            }
        }
        $colNameString = implode(",", $colNameTab);
        $newValueNameString = implode(",", $newValueTab);
        $sql = '
            INSERT INTO `app_user` ('.$colNameString.')
            VALUES ('.$newValueNameString.');';
        $pdoStatement = $pdo->prepare($sql);
        for ($valueIndex = 0; $valueIndex < count($valueNameTab); $valueIndex++) {
            if ($colTypeTab[$valueIndex] === "int" || $colTypeTab[$valueIndex] === "tinyint") {
                $pdoStatement->bindValue($newValueTab[$valueIndex], $valueNameTab[$valueIndex], PDO::PARAM_INT);
            } else {
                $pdoStatement->bindValue($newValueTab[$valueIndex], $valueNameTab[$valueIndex], PDO::PARAM_STR);
            }
        }
        $insertRequest = $pdoStatement->execute();
        return $insertRequest;
    }
    // update current user selected in DB :
    public function update()
    {
        $columnUser = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $pdo = Database::getPDO();
        for ($i = 0; $i < count($columnUser); $i++) {
            $columnName = $columnUser[$i]->COLUMN_NAME;
            if ($columnName != "updated_at" && $columnName != "created_at" && $columnName != "id") {
                $columnName = $columnUser[$i]->COLUMN_NAME;
                $sql = 'UPDATE `app_user` SET
                        `'.$columnName.'` = :newValue,
                        `updated_at` = NOW()
                        WHERE `id` = :id';
                $pdoStatement = $pdo->prepare($sql);
                if ($columnUser[$i]->DATA_TYPE === "int" || $columnUser[$i]->DATA_TYPE === "tinyint") {
                    $pdoStatement->bindValue(':newValue', $this->get($columnName), PDO::PARAM_INT);
                } else {
                    $pdoStatement->bindValue(':newValue', $this->get($columnName), PDO::PARAM_STR);
                }
                $pdoStatement->bindValue(':id', $this->get('id'));
                $updateRequest = $pdoStatement->execute();
            };
        }
        return $updateRequest;
    }
    // public function delete($id, $tableFromDb)
    // {
    //     $pdo = Database::getPDO();
    //     $sql = "
    //         DELETE FROM `".$tableFromDb."`
    //         WHERE `id` = {$id};
    //     ";
    //     $deleteRequest = $pdo->exec($sql);
    //     return $deleteRequest;
    // }
    public function get($property)
    {
        return $this->$property;
    }
    public function set($property, $value)
    {
        $this->$property = $value;
        return $this;
    }
}
