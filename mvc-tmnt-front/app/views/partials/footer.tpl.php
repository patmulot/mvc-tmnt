</div>
<footer class="container-fluid text-center">
    <nav class="row">
        <a class="button_link col-12 col-sm-4" href="<?= $router->generate( 'main.home' ) ?>" ><img id="footer_logo" src="<?= $_SERVER['BASE_URI']."/../docs/images/".$viewVars['common']['informations'][0]->logo; ?>" alt="description du logo"></a>
        <a class="button_link col-12 col-sm-4<?php echo ($viewName == 'about') ? ' link_active' : ''; ?>" href="<?= $router->generate( 'main.about' ); ?>">About</a>
        <a class="button_link col-12 col-sm-4<?php echo ($viewName == 'contact') ? ' link_active' : ''; ?>" href="<?= $router->generate( 'main.contact' ) ?>" >Contact</a>
    </nav>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
</body>
</html>