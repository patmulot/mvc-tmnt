<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

class Type extends CoreModels
{
    private $tableFromDb = "type";
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
            INSERT INTO `type` ('.$colNameString.')
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
                $sql = 'UPDATE `type` SET
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
    // public function delete($id)
    // {
    //     $pdo = Database::getPDO();
    //     $sql = "
    //         DELETE FROM `type`
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
