<section id="interface">
    <div>
        <?php
        if (isset($view['databases'])) {
        ?>
            <form class="select-dropdown" action="/panel/database" method="post">
                <label for="selected_bdd">Choisir BD :</label>
                <select id="slct" name="selected_bdd">
                    <?php
<<<<<<< HEAD
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
=======
                    foreach ($view['databases'] as $database) {
                        foreach ($database as $value) { ?>
                            <option selected><?php echo $value; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <input id="choisir" type="submit" name="submit_bdd" value="Choisir">
            </form>
        <?php
        }
        ?>
        <?php
        if (isset($view['tables'])) {
        ?>
            <section>
                <div class="table">
                    <div class="ligne header">
                        <div class="cellule">
                            <?php echo $view['current_database']; ?>
                        </div>
                        <div class="cellule">
                            Actions
                        </div>
                    </div>

                    <?php
                    foreach ($view['tables'] as $table) { ?>
                        <div class="ligne">
                            <?php foreach ($table as $value) { ?>
                                <div class="cellule"><button type="button" id="<?php echo $value; ?>" class="MyColumn"><?php echo $value; ?></button></div>
                                <div class="cellule" data-title="Actions">
                                    <a class="view-button" href=""><img src="../assets/img/eye.svg" alt="view icon"></a>
                                    <a class="edit-button" href=""><img src="../assets/img/edit.svg" alt="edit icon"></a>
                                    <a class="delete-button" href=""><img src="../assets/img/trash.svg" alt="delete icon"></a>
                                </div>
                        <?php
                            } ?>
                        </div>
                        <?php
                        }
                        ?>

                </div>
            </section>
        <?php
        }
        ?>

    </div>
</section>
>>>>>>> a888fa1b09bfa7e18a9b31ff82f1d29b5e9b6da0
