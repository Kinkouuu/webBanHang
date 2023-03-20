<?php require_once 'view/head.php';
require_once 'view/sidebar.php'; ?>

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
                    <th>#</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sales = $db->query("SELECT * FROM `sale` ORDER BY `s_id` ASC");

                foreach ($sales as $sale) {
                ?>
<form action="" method="POST">
<tr>
                        <td>
                        <input type="number" name="s_id" value="<?= $sale['s_id'] ?>" hidden>
                            <?= $sale['s_id'] ?>
                        </td>
                        <td><?= $sale['code'] ?></td>
                        <td><?= $sale['discount'] ?></td>
                        <td>
                        <a class="btn btn-warning btn-sm" href="saleList.php?s_id=<?= $sale['s_id'] ?>">
                        ✎
                        </a>
                            </td>
                    </tr>
</form>
                <?php } ?>
            </tbody>
        </table>
                </div>
    </div>
</div>
</div>
<?php require_once 'view/end.php'; ?>
