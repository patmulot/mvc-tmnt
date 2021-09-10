<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

class INFORMATION_SCHEMA extends CoreModels
{
    private $TABLE_NAME;
    private $COLUMN_NAME;
    private $DATA_TYPE;
    public static function findAllColumns($tableFromDb)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'" . $tableFromDb . "'";
        $statement = $pdo->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }
    // }
    public function get($property)
    {
        return $this->$property;
    }
}
