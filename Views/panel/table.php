<?php
if(isset($view['tables'])){
    ?>
    <section>
        <table class="datatable datatable_spec table" id="table1">
            <thead>
            <tr>
<!--                <th>--><?php //echo $view['current_database']; ?><!--</th>-->
            </tr>
            <tbody>
            <?php
            foreach ($view['columns'] as $column){
                foreach ($column as $value){ ?>
                    <tr>
                        <td><?php echo $value; ?></td>
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