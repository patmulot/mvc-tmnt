<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

class Product extends CoreModels
{
    private $tableFromDb = "products";
    private $type;
    private $type_id;
    // insert new element in DB :
    public function insert()
    {
        $columns = INFORMATION_SCHEMA::findAllcolumns($this->tableFromDb);
        $pdo = Database::getPDO();
        for ($i = 0; $i < count($columns); $i++) {
            $columnName = $columns[$i]->COLUMN_NAME;
            if ($columnName != "updated_at" && $columnName != "created_at" && $columnName != "id") {
                $colNameTab[] = "`" . $columnName . "`";
                $valueNameTab[] = $this->get($columnName);
                $newValueTab [] = ':' . $columnName;
                $colTypeTab [] = $columns[$i]->DATA_TYPE;
            }
        }
        $colNameString = implode(",", $colNameTab);
        $newValueNameString = implode(",", $newValueTab);
        $sql = '
            INSERT INTO `'.$this->tableFromDb.'` ('.$colNameString.')
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
    public function update()
    {
        $pdo = Database::getPDO();
        $sql = 'UPDATE `products` SET
                `name` = :newName,
                `description` = :newDescription,
                `picture` = :newPicture,
                `type` = :newType,
                `type_id` = :newType_id,
                `updated_at` = NOW()
            WHERE `id` = :id';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':newName', $this->get('name'), PDO::PARAM_STR);
        $pdoStatement->bindValue(':newDescription', $this->get('description'), PDO::PARAM_STR);
        $pdoStatement->bindValue(':newPicture', $this->get('picture'), PDO::PARAM_STR);
        $pdoStatement->bindValue(':newType', $this->get('type'), PDO::PARAM_STR);
        $pdoStatement->bindValue(':newType_id', $this->get('type_id'), PDO::PARAM_INT);
        $pdoStatement->bindValue(':id', $this->id);
        $updateRequest = $pdoStatement->execute();
        return $updateRequest;
    }
    // public function delete($id)
    // {
    //     $pdo = Database::getPDO();
    //     $sql = "
    //         DELETE FROM `products`
    //         WHERE `id` = {$id};
    //     ";
    //     $removeRequest = $pdo->exec($sql);
    //     return $removeRequest;
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
