<?php
namespace App\Models;

use \App\Utils\Database;
use\PDO;

class Informations extends CoreModels
{
    private $tableFromDb = "tmnt_general_informations";
    private $title;
    private $subtitle;
    private $picture;
    private $logo;
    private $icon;
    private $banner;
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
