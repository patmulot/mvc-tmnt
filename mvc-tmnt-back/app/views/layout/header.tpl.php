<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><!-- TODO: -->TMNT<?= ' - ' . $pageName; ?></title>
    <link rel="icon" type="" href="<?= $baseUri . "/../docs/images/" . $informations->get('icon'); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $baseUri ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?= $baseUri ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>
    <header class="container-fluid text-center">
        <div>
            <img id="header_banner" src="<?= $baseUri . "/../docs/images/" . $common['informations']->get('banner'); ?>" alt="description du logo">
            <h1>Les Tortues Ninja - Cowabunga !</h1>
            <!-- <img src="<?= $baseUri . "/../docs/images/" . $informations->get('logo'); ?>" alt=""> -->
        </div>
        <?php 
            // if (isset($_SESSION['appUser'])) { 
                include __DIR__.'/../partials/nav.tpl.php';
        //     }; 
        ?>
</header>
