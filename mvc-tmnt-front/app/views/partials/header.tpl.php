<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMNT<?= ' '.$viewName;?></title>
    <link rel="icon" type="" href="<?= $_SERVER['BASE_URI'] ?>/../docs/images/tmnt_logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $_SERVER['BASE_URI'] ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body><?php // var_dump("coucou"); die(); ?>
    <header class="container-fluid text-center">
        <div>
            <img id="header_banner" src="<?= $_SERVER['BASE_URI']."/../docs/images/".$viewVars['common']['informations'][0]->banner; ?>" alt="description du logo">
            <h1>Les Tortues Ninja - Cowabunga !</h1>
        </div>
        <nav class="row">
            <a class="button_link col-12 col-md-3" href="<?= $router->generate( 'main.home' ) ?>" ><img id="footer_logo" src="<?= $_SERVER['BASE_URI']."/../docs/images/".$viewVars['common']['informations'][0]->logo; ?>" alt="description du logo">
            </a>
            <a class="button_link col-12 col-md-3<?= ($viewName == 'home') ? ' link_active' : ''; ?>" href="<?= $router->generate( 'main.home' ); ?>">Home</a>
            <a class="button_link col-12 col-md-3<?= ($viewName == 'allProduct') ? ' link_active' : ''; ?>" href="<?= $router->generate( 'product.allProduct' ); ?>">All Products</a>
            <a class="button_link col-12 col-md-3<?= ($viewName == 'allType') ? 'link_active' : ''; ?>" href="<?= $router->generate( 'product.allType' ); ?>">All Types</a>
        </nav>
</header>
<div class="container">