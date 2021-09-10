<?php
    namespace app\models;
    use \app\utils\Database;
    use\PDO;
    class Products extends CoreModels
    {
        private $type;
        private $type_id;
        public function findAll()  {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `products`";
            $statement = $pdo->query( $sql );
            $results = $statement->fetchAll( PDO::FETCH_CLASS);
            return $results;
        }
        public function findOne($id)  {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `products` WHERE `id` = $id";
            $statement = $pdo->query( $sql );
            $results = $statement->fetchAll( PDO::FETCH_CLASS );
            return $results;
        }
        public function getType() {
                return $this->type;
        } 
        public function getType_id() {
                return $this->type_id;
        }
    }