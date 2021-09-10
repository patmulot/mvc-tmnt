<?php
    namespace app\models;
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
        public function getName() {
                return $this->name;
        }  
        public function getUpdated_at() {
                return $this->updated_at;
        } 
        public function getCreated_at() {
                return $this->created_at;
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
        public function getDescription() {
                return $this->description;
        } 
        public function getPresentation() {
                return $this->presentation;
        } 
        public function getSubtitle() {
                return $this->subtitle;
        }  
        public function getTitle() {
                return $this->title;
        }  
        public function getId() {
                return $this->id;
        }
    }