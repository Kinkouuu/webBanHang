<?php require_once 'view/head.php'; ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Voucher Discount | <a href="addSale.php">ADD</a></h3>
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
                    <th scope="col">Code</th>
                    <th scope="col">Discount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sales = $db->query("SELECT * FROM `sale` ORDER BY `s_id` ASC");

                foreach ($sales as $sale) {
                ?>
                    <tr>
                        <td><?= $sale['s_id'] ?></td>
                        <td><?= $sale['code'] ?></td>
                        <td><?= $sale['discount'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </div>
    </div>
</div>
</div>
<?php require_once 'view/end.php'; ?>