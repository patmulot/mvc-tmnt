<?php
    //------------------------------------------------------------------
    require_once __DIR__ . "/../vendor/autoload.php";
    //------------------------------------------------------------------
    $baseURL = $_SERVER['BASE_URI'];
    //? $currentURL = $_GET['_url'] ?? "/";
    $router = new AltoRouter();
    $router->setBasePath( $_SERVER['BASE_URI'] );
    //------------------------------------------------------------------
    // MainController :
    $router->map( "GET" , "/" , "MainController@home" , 'main.home' );
    $router->map( 'GET' , '/about' , "MainController@about" , 'main.about' );
    $router->map( 'GET' , '/contact' , "MainController@contact" , 'main.contact' );
    $router->map( 'GET' , '/error404notfound' , "CoreController@error404notfound" , 'core.error404notfound' );
    // ProductController :
    $router->map( 'GET' , '/allProduct' , "ProductController@allProduct" , 'product.allProduct' );
    $router->map( 'GET' , '/oneProduct/[i:id]' , "ProductController@oneProduct" , 'product.oneProduct' );
    $router->map( 'GET' , '/allType' , "ProductController@allProduct" , 'product.allType' );
    $router->map( 'GET' , '/type/[i:id]' , "ProductController@oneProduct" , 'product.type' );
    //------------------------------------------------------------------
    $routeInfo = $router->match();
    $routeInfoArray = explode( "@", $routeInfo['target'] );
    //------------------------------------------------------------------
    $controllerName = "app\\controllers\\" . $routeInfoArray[0];
    $methodName     = $routeInfoArray[1];
    $controller = new $controllerName();
    $controller->$methodName( $routeInfo['params'] );