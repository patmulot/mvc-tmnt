<?php if(($router->match())['name'] == "product.allProduct") {
    $currentPage = 'products1';
} else if(($router->match())['name'] == "product.type") {
    $currentPage = 'type';
} else if(($router->match())['name'] == "product.allType") {
    $currentPage = 'type';
}; ?>
<section class="row">
    <div class="section_header col-12 text-center">
        <h1><?= $viewName ?></h1>
        <p>Description détaillée de tous les produits :</p>
    </div>
    <hr>
    <?php foreach($viewVars[$currentPage] as $products) : ?>
    <article class="col-12">
        <div class="row">
            <div class ="col-12 col-md-6">
                <h2><?= $products->name; ?></h2>
                <?php if ( $currentPage == 'products1' ) : ?>
                <a href="<?= $router->generate( 'product.allType' ); ?>"><?= 'type : '.$products->type;; ?>
                </a>
                <a class="d-block" href="<?= $router->generate( 'product.oneProduct' ).$products->id; ?>">
                    <img class ="col-12" src="<?= $products->picture; ?>" alt="description de l'image">
                </a>
            </div>
            <p class ="col-12 col-md-6">
                <?= $products->description; ?>
            <a class="button_link d-block" href="<?= $router->generate( 'main.home' ) ?>">Accueil</a>
            <a class="button_link d-block" href="<?= $router->generate( 'product.allProduct' ); ?>">Autres produits</a>
            </p>
            <hr>
        <?php endif; ?>
        </div>
    </article>
    <?php endforeach; ?>
</section>