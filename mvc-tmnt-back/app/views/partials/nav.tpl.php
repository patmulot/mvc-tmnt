        <nav class="row">
            <div class="col-12 col-md-2 button_link">
                <a href="<?= $router->generate( 'main-home' ) ?>" ><img class="logo_header" src="<?= $baseUri . "/../docs/images/" . $informations->get('logo'); ?>" alt="description du logo"></a>
            </div>
            <div class="col-12 col-md-2 button_link<?= ($viewName == 'main/home') ? ' link_active' : ''; ?>"">
                <a href="<?= $router->generate( 'main-home' ); ?>"><!-- TODO: -->Home</a>
            </div>
            <div class="col-12 col-md-2 button_link">
                <a href="<?= $router->generate( $connectRoute ); ?>"> <?= $connectBtn; ?> </a>
                <span><?= (isset($userConnected)) ? $userConnected : ''; ?></span>
            </div>
            <?php if (isset($_SESSION['appUser'])) : ?>
            <div class="col-12 col-md-2 button_link <?= ($viewName == 'product/list') ? ' link_active' : ''; ?>">
                <a href="<?= $router->generate( 'product-list' ); ?>"><!-- TODO: -->Products</a>
            </div>
            <div class="col-12 col-md-2 button_link <?= ($viewName == 'product/allType') ? ' link_active' : ''; ?>">
                <a href="<?= $router->generate( 'type-list' ); ?>"><!-- TODO:All Types</a> -->Types</a>
            </div>
            <div class="col-12 col-md-2 button_link <?= ($viewName == 'user/list') ? ' link_active' : ''; ?>">
                <a href="<?= $router->generate( 'user-list' ); ?>">Utilisateurs</a>
            </div> 
            <?php endif; ?>
        </nav>