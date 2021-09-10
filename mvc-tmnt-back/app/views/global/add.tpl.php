<div class="container">
    <section class="row">
        <div class="section_header col-12 text-center">
            <h1><?= $pageName . ' ' . $controllerName; ?></h1>
        </div>
        <hr>
        <a class="button_link col-3" href="<?= $router->generate($controllerName.'-list') ?>">Retour</a>
        <article>
            <form action="<?= $router->generate( $controllerName . '-' . $formAction) . (isset($currentPage) ? $currentPage->id : ''); ?>" method="POST">
                <?php for ($i = 1; $i < count($currentColumn); $i++) :
                if ($currentColumn[$i]->DATA_TYPE != 'timestamp' && $currentColumn[$i]->DATA_TYPE != 'datetime') : ?>
                <div class="form-group">
                    <label for="<?= $currentColumn[$i]->COLUMN_NAME; ?>"><?= $currentColumn[$i]->COLUMN_NAME; ?></label>
                    <<?= $formItem[$i]; ?> value="<?= isset($currentPage) ? $currentPage->get($currentColumn[$i]->COLUMN_NAME): ''; ?>" type="<?= $currentType[$i]; ?>" name="<?= $currentColumn[$i]->COLUMN_NAME; ?>" id="<?= $currentColumn[$i]->COLUMN_NAME; ?>" class="form-control"
                    <?php if ($formItem[$i] === 'select') : ?>>
                        <?php foreach ($optionsTab[$currentColumn[$i]->COLUMN_NAME] as $value) : ?>
                            <option value ="<?= $value; ?>"><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php else : ?>
                        placeholder="<?= 'Enter new ' . $currentColumn[$i]->COLUMN_NAME . '...'; ?>">
                    <?php endif; ?>
                </div>
                <?php endif; endfor; ?>
                <button type="submit" class="button_link">Valider</button>
            </form>
        </article>
            
    </section>
</div>