<div class="container">
    <section class="row">
        <div class="section_header col-12 text-center">
            <h1><?= $pageName . ' ' . $controllerName; ?></h1>
        </div>
        <hr>
        <a class="button_link col-3" href="<?= $router->generate( $controllerName.'-add' ) ?>">Ajouter</a>
        <article class="col-12 main_article scroll_container">
            <table>
                <tr>
                    <td></td>
                    <?php for ($i = 0; $i < count($currentColumn); $i++) : ?>
                    <td class="table_row_first" scope="col"><h3><?= $currentColumn[$i]->COLUMN_NAME; ?></h3></td>
                    <?php endfor; ?>
                </tr>
                <?php for ($i = 0; $i < count($currentPage); $i++) : ?> 
                <tr class="table_row">
                    <td class="table_btns">
                        <div class="table_btn">
                            <a href="<?= $router->generate( $controllerName.'-edit') . $currentPage[$i]->id ?>"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="table_btn">
                            <a class="delete_btn"><i class="fas fa-trash"></i></a>
                            <a class="delete_btn delete_action" href="<?= $router->generate( $controllerName.'-delete') . $currentPage[$i]->id ?>">
                                <i class="fas fa-trash"></i>
                                <p class="text_delete">Supprimer? </p>
                            </a>
                        </div>
                    </td>
                    <?php foreach ($currentPage[$i] as $element) : ?>
                    <td class="table_cell" scope="col">
                        <?php echo $element; ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endfor; ?>
            </table>
        </article>
    </section>
</div>