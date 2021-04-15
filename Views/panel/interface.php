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
        <table id="table1" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Gestion</th>
            </tr>
            <tbody>
                <?php
                foreach ($view['tables'] as $table){
                    foreach ($table as $value){ ?>
                        <tr>
                            <td>
                                <p><?php echo $value; ?></p>
                            </td>
                            <td>
                                <button type="button" id="<?php echo $value; ?>" class="View btn btn-info glyphicon glyphicon-eye-open btn-xs" data-toggle="modal" data-target="#modalView"></button>
                                <button type="button" id="<?php echo $value; ?>" class="Edit btn btn-warning glyphicon glyphicon-pencil btn-xs"></button>
                                <button type="button" id="<?php echo $value; ?>" class="Delete btn btn-danger glyphicon glyphicon-remove btn-xs"></button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    TOTO
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php
}
?>
