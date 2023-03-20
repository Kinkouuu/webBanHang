<?php require_once 'view/head.php';
require_once 'view/sidebar.php'; ?>

<?php
if (isset($_POST['save'])) {
    $m_id = mpost('m_id');
    $cur = mpost('cur');
    $ex = mpost('ex');

    $db->exec("UPDATE `money` SET `ex` = '$ex' WHERE `m_id` = '$m_id'");
    echo '<script>alert("Đã cập nhật tỉ giá 1' . $cur . ' = ' . $ex . ' VND"); window.location = "money.php";</script>';
}
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Currency Exchange | <a href="addMoney.php">ADD</a></h3>
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
                        <th scope="col">Currency Type</th>
                        <th scope="col">Exchange</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tiens = $db->query("SELECT * FROM `money` ORDER BY `m_id` ASC");

                    foreach ($tiens as $tien) {
                        $m_id = $tien['m_id'];
                    ?>
                        <tr>
                            <form action="" method="POST">
                                <td>
                                    <input type="text" name="m_id" hidden value="<?= $m_id ?>"><?= $tien['m_id'] ?>
                                </td>
                                <td>
                                    <input type="text" name="cur" hidden value="<?= $tien['cur'] ?>"><?= $tien['cur'] ?>(<?= $tien['sign'] ?>)
                                </td>
                                <td> <input type="text" name="ex" value="<?= $tien['ex'] ?>"> VND</td>
                                <td>
                                    <button type="submit" name="save" class="btn btn-success">
                                        <i class="fas fa-solid fa-check"></i>
                                    </button>
                                </td>

                            </form>





                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php require_once 'view/end.php'; ?>