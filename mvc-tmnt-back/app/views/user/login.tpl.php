<div class="container">
    <section class="row">
        <div class="section_header col-12 text-center">
            <h1>Page de connexion</h1>
        </div>
        <hr>
        <?php if(isset($message)) : ?>
        <h2><?= $message; ?></h2>
        <?php endif; ?>
        <form action="<?= $router->generate('user-connect') ?>" method="POST" class="mt-5">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" value="tmnt@tmnt.tmnt">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
            </div>
            <button type="submit" class="button_link">Valider</button>
        </form>
    </section>
</div>