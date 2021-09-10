<div class="container">
    <section class="row">
        <div class="section_header col-12 text-center">
            <h1>Produit : <?= $pageName; ?></h1>
        </div>

                <table><br>
            <a class="button_link col-3" href="<?= $router->generate('product-allProduct') ?>">Retour</a>
            <a class="button_link col-3" href="<?= $router->generate('product-deleteProduct') . $currentPage->id ?>">Supprimer</a>
                    <!-- <caption>TODO:</caption> -->
                    <tr class="first_table_row" ><!-- column name -->
                        <?php for ($i = 0; $i < count($currentColumn); $i++) : ?>
                        <th class="first_row" scope="col"><h3><?= $currentColumn[$i]->COLUMN_NAME; ?></h3></th>
                        <?php endfor; ?>
                    </tr>
                    <tr class="table_row" ><!-- rows -->

                        <?php foreach ($currentPage as $element) : ?>
                        <td class="table_row" scope="col"><?php echo $element; ?>
                        </td>
                        <?php endforeach; ?>

                    </tr>

                </table>
    </section>
</div>