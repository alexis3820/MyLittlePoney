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
        <table>
            <thead>
            <tr>
                <th colspan="2"><?php echo $view['current_database']; ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                foreach ($view['tables'] as $table){
                    foreach ($table as $value){ ?>
                        <td><?php echo $value; ?></td>
                        <?php
                    }
                }
                ?>
            </tr>
            </tbody>
        </table>
    </section>
<?php
}
?>
