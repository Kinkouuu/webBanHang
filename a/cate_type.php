<?php require_once 'head.php'; ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category & Type | <a href="addType.php">ADD</a></h3>
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
                    <th scope="col">Category</th>
                    <th scope="col">Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $types = $db->query("SELECT * FROM `type` ORDER BY `type` ASC");

                foreach ($types as $type) {
                    $t_id= $type['t_id'];
                ?>
                    <tr>
                        <td><?= $type['t_id'] ?></td>
                        <td><?= $type['cate'] ?></td>
                        <td><?= $type['type'] ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </div>
    </div>
</div>
</div>
<?php require_once 'end.php'; ?>