<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

 class CoreModels
 {
     private $id;
     private $title;
     private $name;
     private $subtitle;
     private $presentation;
     private $description;
     private $picture;
     private $logo;
     private $banner;
     private $created_at;
     private $updated_at;
     public function get($property)
     {
         return $this->$property;
     }
     public function set($property, $value)
     {
         $this->$property = $value;
         return $this;
     }
     public static function findAll($tableFromDb)
     {
         $pdo = Database::getPDO();
         $sql = "SELECT * FROM `" . $tableFromDb . "`";
         $statement = $pdo->query($sql);
         $results = $statement->fetchAll(PDO::FETCH_CLASS);
         return $results;
     }
     public static function findOne($id, $tableFromDb, $model)
     {
         $pdo = Database::getPDO();
         $sql = "SELECT * FROM `" . $tableFromDb . "` WHERE `id` = $id";
         $statement = $pdo->query($sql);
         $results = $statement->fetchObject('App\Models\\'.$model);
         return $results;
     }
     public function delete($id, $tableFromDb)
     {
         $pdo = Database::getPDO();
         $sql = "
             DELETE FROM `".$tableFromDb."`
             WHERE `id` = {$id};
         ";
         $deleteRequest = $pdo->exec($sql);
         return $deleteRequest;
     }
 }
