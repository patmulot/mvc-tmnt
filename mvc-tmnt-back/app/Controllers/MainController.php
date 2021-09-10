<?php

namespace App\Controllers;

use \App\Models\Product;
use \App\Models\User;
use \App\Models\Type;
use \App\Models\INFORMATION_SCHEMA;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $columnProducts = INFORMATION_SCHEMA::findAllcolumns("products");
        $products = Product::findAll("products");
        $productsElements = [
            'columns' => $columnProducts,
            'items' => $products,
            'controller' => 'product',
            'title' => 'Products',
        ];
        $columnUsers = INFORMATION_SCHEMA::findAllcolumns("app_user");
        $productsUsers = User::findAll("app_user");
        $usersElements = [
            'columns' => $columnUsers,
            'items' => $productsUsers,
            'controller' => 'user',
            'title' => 'Users',
        ];
        $columnTypess = INFORMATION_SCHEMA::findAllcolumns("type");
        $typessUsers = Type::findAll("type");
        $typesElements = [
            'columns' => $columnTypess,
            'items' => $typessUsers,
            'controller' => 'type',
            'title' => 'Types',
        ];
        $viewVars[ 'elements' ] = [
            'productsElements' => $productsElements,
            'usersElements' => $usersElements,
            'typesElements' => $typesElements,
        ];
        $this->show('main/home', $viewVars);
    }
}
