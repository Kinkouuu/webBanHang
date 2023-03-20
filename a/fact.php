<?php require_once 'view/head.php';
require_once 'view/sidebar.php';
 ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Supply Factory Account | <a href="addFact.php">ADD</a></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>

            </div>
        </div>
        <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Factory</th>
                    <th scope="col">Product</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $facts = $db->query("SELECT * FROM `factory` ORDER BY `f_id` ASC");

                foreach ($facts as $fact) {
                    $f_id = $fact['f_id'];
                    $count = $db->query("SELECT p_id FROM `product` WHERE `f_id` = '$f_id'")->rowCount();
                ?>
                    <tr>
                        <td><?= $fact['f_id'] ?></td>
                        <td><?= $fact['f_name'] ?></td>
                        <td><?= $count ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </div>
    </div>
</div>
</div>
<?php require_once 'view/end.php'; ?>