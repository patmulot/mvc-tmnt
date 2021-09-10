<?php
    namespace app\controllers;
    class MainController extends CoreController
    {
        public function home() {
            $this->show( "home");
        }
        public function about() {
            $this->show( "about" );
        }
        public function contact() {
            $this->show( "contact" );
        }
    };