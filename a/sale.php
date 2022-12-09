<?php require_once 'view/head.php'; ?>
<?php
if(isset($_POST['save'])){
    $s_id = locdata($_POST['s_id']);
    $max = locdata($_POST['max']);
    $l_uid = locdata($_POST['l_uid']);

    // echo $max;
    // echo $l_uid;
    $db->exec("UPDATE `sale` SET `max`='$max',`l_uid`='$l_uid' WHERE `s_id` = '$s_id'");
}
?>
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
                    <th>Number of uses</th>
                    <th>User ID</th>
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
                            <input type="number" min ="0" name="max" value="<?= $sale['max'] ?>">
                        </td>
                        <td>
                            <input type="number" min ="0" name="l_uid" value="<?= $sale['l_uid'] ?>">
                        </td>
                        <td>

                                <button type="submit" name="save" class="btn btn-success">
                                <i class="fas fa-solid fa-check"></i>
                                </button>
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