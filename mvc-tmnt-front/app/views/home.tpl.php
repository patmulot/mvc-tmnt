    <section class="row">
        <div class="section_header col-12 text-center">
            <h1><?= $viewVars['common']['informations'][0]->title; ?></h1>
            <h2><?= $viewVars['common']['informations'][0]->subtitle; ?></h2>
        </div>
        <hr>
        <img src="<?= $_SERVER['BASE_URI']."/../docs/images/".$viewVars['common']['informations'][0]->picture; ?>" alt="description de l'image">
        <article class="col-12 main_article">
            <h3>Presentation</h3>
            <p>
            <?= $viewVars['common']['informations'][0]->presentation; ?>
        </p>
        <hr>
        </article>
        <article class="col-12">
            <h3>Description</h3>
            <p>
            <?= $viewVars['common']['informations'][0]->description; ?>
        </p>
        <hr>
        </article>
    </section>
    <section class="row">
        <div class="section_header col-12 text-center">
            <h1>Produits en avant</h1>
        </div>
        <?php foreach($viewVars['common']['products'] as $homeProduct) :
        if( $homeProduct->id < 3 ) {$col = 6;} else {
            $col = 4;
        }; ?>
        <article class="col-<?= $col; ?> text-center">
            <div class="row">
                <h2><?= $homeProduct->name ?></h2>
                <a href="<?= $router->generate( 'product.oneProduct' ).$homeProduct->type_id; ?>">
                <?= $homeProduct->type ?>
                </a>
            </div>
            <div class="img_style"><?php //var_dump($homeProduct->picture); die(); ?>
                <a href="<?= $router->generate( 'product.oneProduct' ).$homeProduct->id; ?>">
                    <img class="col-8" src="<?= $homeProduct->picture; ?>" alt="description de l'image">
                </a>
            </div>
        </article>
        <?php endforeach; ?>
    </section>