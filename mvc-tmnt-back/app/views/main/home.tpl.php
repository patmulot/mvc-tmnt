<div class="container">
    <section class="row">
        <?php foreach ($elements as $element) : ?>
        <div class="section_header col-12 text-center mt-5">
            <h1><?= $element['title']; ?></h1>
        </div>
        <article class="col-12 main_article scroll_container">
            <table>
                <tr>
                    <?php for ($i = 0; $i < count($element['columns']); $i++) : ?>
                    <td class="table_row_first" scope="col"><h3><?= $element['columns'][$i]->COLUMN_NAME; ?></h3></td>
                    <?php endfor; ?>
                </tr>
                <?php for ($i = 0; $i < 3; $i++) : ?> 
                <tr class="table_row">
                    <?php foreach ($element['items'][$i] as $item) : ?>
                    <td class="table_cell" scope="col">
                        <?php echo $item; ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endfor; ?>
            </table>
            <a class="button_link col-3" href="<?= $router->generate( $element['controller'] . '-list' ) ?>">voir plus</a>
        </article>
        <?php endforeach; ?>
    </section>
</div>