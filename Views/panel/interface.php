<?php
if(isset($view['databases'])){
    ?>

    <div class="alert alert-danger AlertTableDelete" role="alert" style="display: none">
        Vous avez bien supprimé la table
    </div>
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
        <h1><?php echo $view['current_database']; ?></h1>
        <?php
            if(isset($view['message'])){
        ?>
        <h2><?php echo $view['message']; ?></h2>
            <?php }?>
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
                                <button type="button" id="<?php echo $value; ?>" class="Edit btn btn-warning glyphicon glyphicon-pencil btn-xs" data-toggle="modal" data-target="#modalEdit"></button>
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
        <div class="modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title-view" id="exampleModalLabel" style="margin-left: 10px">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h2>
                </div>
                <div class="modal-body-view">
                    <table id="editTable" class="table table-striped table-bordered" style="width: 1300px;">
                        <thead>
                        <tr class="DataTr">
                        </tr>
                        </thead>
                        <tbody class="DataTd">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="ButtonClass">

                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header-edit">
                    <h5 class="modal-title" id="exampleModalLabel"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body-edit">
                    <form action="/panel/editTableName" method="post">
                        <input type="text" id="newTable" name="newTableName">
                        <input type="text" id="oldTable" name="oldTableName" hidden>
                        <input type="submit" value="Modifier">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header-edit">
                    <h5 class="modal-title" id="exampleModalLabel"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body-edit">
                    <form action="/panel/updateDataTable" method="post" id="form-edit-data">

                    </form>
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
