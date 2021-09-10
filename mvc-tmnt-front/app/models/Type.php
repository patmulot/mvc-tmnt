<?php
    namespace app\models;
    use \app\utils\Database;
    use\PDO;
    class Type extends CoreModels
    {
        public function findAll()  {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `type`";
            $statement = $pdo->query( $sql );
            $results = $statement->fetchAll( PDO::FETCH_CLASS );
            return $results;
        }
        public function findOne($id)  {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `type` WHERE `id` = $id";
            $statement = $pdo->query( $sql );
            $results = $statement->fetchAll( PDO::FETCH_CLASS );
            return $results;
        }
    }