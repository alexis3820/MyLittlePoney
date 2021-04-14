<?php
if(isset($view['databases'])){
    ?>
    <form action="/panel/database" method="post">
        <label for="selected_bdd">Choisir une base de données :</label>
        <select class="form-select mt-1 mb-2" name="selected_bdd">
            <?php
            foreach ($view['databases'] as $database){
                foreach ($database as $value){ ?>
                    <option selected><?php echo $value; ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <input type="submit" name="submit_bdd" value="Choisir">
    </form>
    <?php
}
?>
<?php
if(isset($view['tables'])){
    ?>
    <section>
        <table class="table table-striped" id="table1">
            <thead>
            <tr>
                <th><?php echo $view['current_database']; ?></th>
            </tr>
            <tbody>
                <?php
                foreach ($view['tables'] as $table){
                    foreach ($table as $value){ ?>
                        <tr>
                            <td><button type="button" id="<?php echo $value; ?>" class="MyColumn"><?php echo $value; ?></button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
<?php
}
?>
