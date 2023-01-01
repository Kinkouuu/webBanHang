<?php require_once 'view/head.php' ?>

<?php
$s_id = mget('s_id');
$ds = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id'")->fetch();
?>
<?php
//them tat ca nguoi dung
if (isset($_POST['addAll'])) {
    $add = $db->query("SELECT * FROM `user` WHERE `u_id` NOT IN (SELECT `u_id` FROM `sale_list` WHERE `s_id` = '$s_id')");
    foreach ($add as $row) {
        $u_id = $row['u_id'];
        // echo $u_id;
        $db->exec("INSERT INTO `sale_list` (`s_id`, `u_id`,`max`) VALUES ('$s_id', '$u_id', '1')");
    }
}
//xoa tat ca nguoi dung
if (isset($_POST['delAll'])) {
    $db->exec("DELETE FROM `sale_list` WHERE `s_id`='$s_id'");
}
//them nguoi dung vao danh sach
if (isset($_GET['add'])) { 
    $a_id = mget('add');
    // echo $s_id."=" .$a_id;
    $count = $db->query("SELECT * FROM `sale_list` WHERE `s_id` = '$s_id' AND `u_id` = '$a_id'")->rowCount();
    if ($count == 0) {
        $db->exec("INSERT INTO `sale_list` (`s_id`, `u_id`,`max`) VALUES ( '$s_id', '$a_id','1')");
        echo '<script> window.location = "?s_id=' . $s_id . ' "; </script>';
    } else {
        echo '<script>alert("This product has been added in group by list");window.location = "?s_id=' . $s_id . ' "; </script>';
    }
}
if (isset($_GET['rmv'])) { // xoa san pham khoi gb list
    $r_id =  mget('rmv');
    $db->exec("DELETE FROM `sale_list` WHERE `s_id` = '$s_id' AND `u_id` = '$r_id';");
    echo '<script>window.location = "?s_id=' . $s_id . ' "; </script>';
}
if(isset($_POST['save'])) { // thay doi so lan su dung
    $u_id = mpost('u_id');
    $max = mpost('max');
    $db->exec("UPDATE `sale_list` SET `max` = '$max' WHERE `u_id` = '$u_id' AND `s_id` = '$s_id'");

}
?>

<div class="container-fluid">
    <form method="POST">
        <!-- thong tin giam gia -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 d-flex">
                    <div class="col-md-1">
                        <label for="">Voucher ID: </label>
                    </div>
                    <div class="col-md-1">
                        <?php echo $s_id ?>
                    </div>
                    <div class="col-md-1">
                        <label for="">Code: </label>
                    </div>
                    <div class="col-md-2">
                        <?php echo $ds['code']?>
                    </div>
                    <div class="col-md-1">
                        <label for="">Discount: </label>
                    </div>
                    <div class="col-md-3">
                        <?php echo number_format($ds['discount']) . " VND" ?>
                    </div>
                    <div class="col-md-1">
                        <input type="submit" name="addAll" class="btn-primary" value="ADD ALL">
                    </div>
                    <div class="col-md-1">
                    <input type="submit" name="delAll" class="btn-danger" value="DELL ALL">
                    </div>
                </div>
            </div>
        </div>

        <!-- danh sach nguoi dung -->
        <div class="col-md-12">
            <div class="row">
                <!-- danh sach nguoi ko duoc dung -->
                <div class="col-sm-5" style="overflow-y: auto;height:80vh">
                    <table class="table table-striped">

                        <caption style="caption-side:top">ALL USERS</caption>
                        <tr>
                            <th>ID User</th>
                            <th>Phone Number </th>
                            <th>Name User</th>
                            <th>&nbsp</th>
                        </tr>
                        <?php
                        $user = $db->query("SELECT * FROM `user` WHERE `u_id` NOT IN (SELECT `u_id` FROM `sale_list` WHERE `s_id` = '$s_id')");
                        foreach ($user as $row) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $row['u_id'] ?>
                                </td>
                                <td>
                                    <?php echo $row['phone'] ?>
                                </td>
                                <td>
                                    <?php echo $row['f_name'] . " " . $row['l_name'] ?>
                                </td>
                                <td>
                                    <a id="add" href="?s_id=<?= $s_id ?>&add=<?= $row['u_id'] ?> ">✚</a>
                                </td>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                <!-- danh sach nguoi duoc dung -->
                <div class="col-sm-7" style="overflow-y: auto;height:80vh">
                    <table class="table table-striped">
                        <caption style="caption-side:top">USERS CAN USE</caption>
                        <tr>
                            <th>ID User</th>
                            <th>Phone Number </th>
                            <th>Name User</th>
                            <th>Number of use
                            <small class="rounded-circle btn btn-default pb-1 p-0 m-0" data-toggle="tooltip" data-placement="right" title="Giới hạn số lần sử dụng mã giảm giá." style="width: 12%;">
                                <i class="fas fa-solid fa-question"></i>
                                </small>
                            </th>
                            <th>&nbsp</th>
                            <th>&nbsp</th>
                        </tr>
                        <?php
                        $use = $db->query("SELECT * FROM (`user` INNER JOIN `sale_list` ON `user`.u_id = `sale_list`.u_id) INNER JOIN `sale` ON `sale_list`.s_id = `sale`.s_id WHERE `sale_list`.s_id='$s_id'");
                        foreach ($use as $list) {
                        ?>
                            <form action="" method="POST">
                            <tr>
                                                            <td>
                                                                <input type="hidden" name="u_id" value="<?= $list['u_id']?>">
                                                                <?php echo $list['u_id'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $list['phone'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $list['f_name'] . " " . $list['l_name'] ?>
                                                            </td>
                                                            <td>
                                                                <input type="number" min="0" id="max" name="max" value="<?= $list['max'] ?>">
                                                            </td>
                                                            <td>
                                                                <button type="submit" name="save" class="btn btn-link">✓</button>
                                                            </td>
                                                            <td>
                                                                <a id="rmv" href="?s_id=<?= $s_id ?>&rmv=<?= $list['u_id'] ?> ">✘</a>
                                                            </td>
                                                            </td>
                                                        </tr>
                            </form>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

        </div>
    </form>
</div>

</div>
<?php require_once 'view/end.php' ?>