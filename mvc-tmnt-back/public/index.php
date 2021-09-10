<?php
require_once '../vendor/autoload.php';
// Starting session to connect user
session_start();
// dump($_SESSION);//!
// $_SESSION['monAppUser'] = 'objet utilisateur';
// dump($_SESSION);//!
/* ------------
--- ROUTAGE ---
-------------*/
$router = new AltoRouter();
if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
}
else {
    $_SERVER['BASE_URI'] = '/';
}
// =================//
// MAIN CONTROLLER //
// ===============//
// home :
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);
// about
$router->map(
    'GET',
    '/about',
    [
        'method' => 'about',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-about'
);
// contact
$router->map(
    'GET',
    '/contact',
    [
        'method' => 'contact',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-contact'
);
// ====================//
// PRODUCT CONTROLLER //
// ==================//
// SHOW all products :
$router->map(
    'GET',
    '/product',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-list'
);
// SHOW one products :
$router->map(
    'GET',
    '/product/[i:id]',
    [
        'method' => 'oneProduct',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-oneProduct'
);
// =============//
// PRODUCT NEW //
// ===========//
// add product page view
$router->map(
    'GET',
    '/product/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-add'
);
// getting datas from POST form
$router->map(
    'POST',
    '/product/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-create'
);
// ================//
// PRODUCT MODIFY //
// ==============//
// EDIT
$router->map( //route edit vers update
    'GET',
    '/product/productUpdate/[i:id]', 
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-edit'
);
// UPDATE
$router->map(
    'POST',
    '/product/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-update'
);
// ================//
// PRODUCT REMOVE //
// ==============//
// DELETE
$router->map( //route edit vers update
    'GET',
    '/product/deleteProduct/[i:id]', 
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\ProductController'
    ],
    'product-delete'
);
// =================//
// USER CONTROLLER //
// ===============//
// SHOW LOGIN
$router->map( // route to connexion form
    'GET',
    '/user/login', 
    [
        'method' => 'login',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-login'
);
// CONNEXION
$router->map( // getting form to connect user
    'POST',
    '/user/login', 
    [
        'method' => 'connect',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-connect'
);
// LOGOUT
$router->map( // disconnect user
    'GET',
    '/user/logout', 
    [
        'method' => 'logout',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-logout'
);
// SHOW all users :
$router->map( // disconnect user
    'GET',
    '/user/list', 
    [
        'method' => 'list',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-list'
);
// ==========//
// USER NEW //
// ========//
// add product page view
$router->map(
    'GET',
    '/user/addUser',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-add'
);
// getting datas from POST form
$router->map(
    'POST',
    '/user/addUser',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-create'
);
// =============//
// USER MODIFY //
// ===========//
// EDIT user :
$router->map( //route edit vers update
    'GET',
    '/user/userUpdate/[i:id]', 
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-edit'
);
// UPDATE user :
$router->map(
    'POST',
    '/user/userUpdate/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-update'
);
// =============//
// USER REMOVE //
// ===========//
// DELETE
$router->map( //route edit vers update
    'GET',
    '/user/deleteUser/[i:id]', 
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-delete'
);
// =================//
// TYPE CONTROLLER //
// ===============//
// SHOW all types :
$router->map(
    'GET',
    '/type',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-list'
);
// // SHOW one type :
// $router->map(
//     'GET',
//     '/type/[i:id]',
//     [
//         'method' => 'oneType',
//         'controller' => '\App\Controllers\ProductController'
//     ],
//     'product-oneType'
// );
// =============//
// TYPE NEW //
// ===========//
// add product page view
$router->map(
    'GET',
    '/type/add',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-add'
);
// getting datas from POST form
$router->map(
    'POST',
    '/type/add',
    [
        'method' => 'create',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-create'
);
// =============//
// TYPE MODIFY //
// ===========//
// EDIT
$router->map( //route edit vers update
    'GET',
    '/type/update/[i:id]', 
    [
        'method' => 'edit',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-edit'
);
// UPDATE
$router->map(
    'POST',
    '/type/update/[i:id]',
    [
        'method' => 'update',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-update'
);
// =============//
// TYPE REMOVE //
// ===========//
// DELETE
$router->map( //route edit vers update
    'GET',
    '/type/delete/[i:id]', 
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\TypeController'
    ],
    'type-delete'
);
/* -------------
--- DISPATCH ---
--------------*/
$match = $router->match();
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
$dispatcher->dispatch();