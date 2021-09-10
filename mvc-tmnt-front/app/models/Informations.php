<?php
    namespace app\models;
    use \app\utils\Database;
    use\PDO;
    class Informations extends CoreModels
    {
        private $title;
        private $subtitle;
        private $picture;
        private $logo;
        private $banner;
        public function findAll() {
            $pdo = Database::getPDO();
            $sql = "SELECT * FROM `tmnt_general_informations`";
            $statement = $pdo->query( $sql );
            $results = $statement->fetchAll( PDO::FETCH_CLASS );
            return $results;
        }
        public function getLogo() {
                return $this->logo;
        } 
        public function getBanner() {
                return $this->banner;
        } 
        public function getPicture() {
                return $this->picture;
        } 
        public function getSubtitle() {
                return $this->subtitle;
        }  
        public function getTitle() {
                return $this->title;
        }
    }