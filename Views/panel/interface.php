

<section id="interface">
    <div>
        <?php
        if (isset($view['databases'])) {
            ?>
            <form class="select-dropdown" action="/panel/database" method="post">
                <label for="selected_bdd">Choisir BD :</label>
                <select id="slct" name="selected_bdd">
                    <?php
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
                                <div class="cellule"><?php echo $value; ?></div>
                                <div class="cellule" data-title="Actions">
                                    <button class="view-button MyColumn glyphicon glyphicon-asterisk" type="button" id="<?php echo $value; ?>" ></button>
                                    <button class="edit-button MyColumn glyphicon glyphicon-asterisk" type="button" id="<?php echo $value; ?>" ></button>
                                    <button class="delete-button MyColumn glyphicon glyphicon-asterisk" type="button" id="<?php echo $value; ?>" ></button>
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
<!-- <div></div> -->
    </div>
</section>

