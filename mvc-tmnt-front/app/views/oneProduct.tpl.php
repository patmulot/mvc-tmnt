<?php if($viewName == "oneProduct") {
    $currentPage = 'oneProducts';
} else if($viewName == "oneType") {
    $currentPage = 'oneType';
}; ?>
<section class="row">
    <div class="section_header col-12 text-center">
        <h1>PRODUIT : </h1>
    </div>
    <hr>
    <article class="col-12">
        <div class="row">
            <div class ="col-12 col-md-6">
                <h2><?= $viewVars[$currentPage][0]->name; ?></h2>
                <a href="<?= $router->generate( 'product.allType' ); ?>"><?= 'type : '.$viewVars[$currentPage][0]->type;; ?>
                </a>
            <img class="col-12" src="<?= $viewVars[$currentPage][0]->picture; ?>" alt="description de l'image">
            </div>
            <div class ="col-12 col-md-6">
                <p class="row">
                <?= $viewVars[$currentPage][0]->description; ?>
                <a class="row" href="<?= $router->generate( 'main.home' ) ?>">Accueil</a>
                <a class="row" href="<?= $router->generate( 'product.allProduct' ); ?>">Autres produits</a>
                </p>
            </div>
        </div>
    </article>
</section>