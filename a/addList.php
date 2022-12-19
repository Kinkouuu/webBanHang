<?php require_once 'view/head.php';
?>
<?php
$g_id = $_GET['g_id'];
$list = $db->query("SELECT * FROM `gb` WHERE `g_id` = '$g_id'")->fetch();
$today = strtotime(date('Y-m-d H:i:s'));
// echo $today;

if (isset($_GET['save'])) {
    $g_id = mget('g_id');
    $s_day = mget('s_day');
    $s_date = DateTime::createFromFormat('d-m-Y', $s_day)->getTimestamp();
    $e_day = mget('e_day');
    $e_date = DateTime::createFromFormat('d-m-Y', $e_day)->getTimestamp();
    $stt = mget('stt');
    // echo $g_id . ' from ' . $s_date. ' to ' . $e_date;
    $db->exec("UPDATE `gb` SET `s_date` = '$s_date',`e_date`='$e_date',`gb_stt` = '$stt' WHERE `g_id` = '$g_id'");
    $dt = $db->query("SELECT DISTINCT `o_id` FROM `details` WHERE `g_id` = '$g_id'");
        foreach($dt as $r){
            $o_id = $r['o_id'];
            $db ->exec("UPDATE `order` SET `status` = '$stt' WHERE `o_id` = '$o_id'");
        }
    echo '<script>alert("Updated batch ' . $list['g_name'] . '"); window.location = "?g_id=' . $g_id . ' ";</script>';
}

if (isset($_GET['add'])) { // them san pham gb
    $a_id = mget('add');
    $count = $db->query("SELECT * FROM `gb_list` WHERE `g_id` = '$g_id' AND `p_id` = '$a_id'")->rowCount();
    if ($count == 0) {
        $db->exec("INSERT INTO `gb_list` (`g_id`, `p_id`) VALUES ( '$g_id', '$a_id');");
        echo '<script> window.location = "?g_id=' . $g_id . ' "; </script>';
    } else {
        echo '<script>alert("This product has been added in group by list");window.location = "?g_id=' . $g_id . ' "; </script>';
    }
}
if (isset($_GET['rmv'])) { // xoa san pham khoi gb list
    $r_id =  mget('rmv');

    $db->exec("DELETE FROM `gb_list` WHERE `g_id` = '$g_id' AND `p_id` = '$r_id';");
}

?>

<div class="container-fluid m-2">
    <div class="col-md-12">
        <div class="row">


                    <form class="d-flex" method="GET">
                        <div class="col-md-2 d-flex">
                            <label for="" class="col-sm-6">ID group buy: </label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" name="g_id" readonly value="<?= $g_id ?>"> 
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <label for="" class="col-sm-6">From:</label>
                            <div class="col-sm-6">
                                <input type="text" name="s_day" id="date_picker1" class="form-control" value="<?= date("d-m-Y", $list['s_date']) ?>">

                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <label for="" class="col-sm-6">To:</label>
                            <div class="col-sm-6">

                                <input type="text" name="e_day" id="date_picker2" class="form-control" value="<?= date("d-m-Y", $list['e_date']) ?>">
                            </div>
                        </div>

                        <div class="col-md-3 d-flex">
                            <label class="col-sm-6">Status:</label>
                            <div class="col-sm-6">
                                <select class="form-select" name="stt">
                                <option value="Đang mở group buy" <?php echo $list['gb_stt'] == 'Đang mở group buy' ? ' selected ' : ''; ?>>Đang mở group buy</option>
                                <option value="Đóng order" <?php echo $list['gb_stt'] == 'Đóng order' ? ' selected ' : ''; ?>>Đóng order</option>
                                <option value="Đặt hàng nhà máy" <?php echo $list['gb_stt'] == 'Đặt hàng nhà máy' ? ' selected ' : ''; ?>>Đặt hàng nhà máy</option>
                                <option value="Hàng ra khỏi nhà máy" <?php echo $list['gb_stt'] == 'Hàng ra khỏi nhà máy' ? ' selected ' : ''; ?>>Hàng ra khỏi nhà máy</option>
                                <option value="Đã thông quan" <?php echo $list['gb_stt'] == 'Đã thông quan' ? ' selected ' : ''; ?>>Đã thông quan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" name="save" class="btn btn-success">✔</button>
                        </div>
                    </form>


        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <!-- table view -->
            <div class="col-sm-12 m-1">
                <form method="POST">
                    <select class="select-type" name="type" aria-label="Default select example">
                        <option selected value="">All type product</option>
                        <?php
                        $type = $db->query("SELECT * FROM `type` WHERE `type`.type != '' order by `t_id` ASC");
                        foreach ($type as $t) {
                        ?>
                            <option value="<?= $t['t_id'] ?>"><?php echo $t['type'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="submit" name="submit" value="✔">
                    <div class="row">

                        <div class="col-sm-6" style="overflow-y: auto;height:60vh">
                            <table class="table table-striped">
                                <caption style="caption-side:top">ALL PRODUCTS</caption>
                                <tr>
                                    <th>ID product</th>
                                    <th>Name product</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <?php
                                if (isset($_POST['submit']) && $_POST['type'] != "") {
                                    $type = $_POST['type'];
                                    $c_p = $db->query("SELECT * FROM (`product` INNER JOIN `money` ON `product`.m_id = `money`.m_id) INNER JOIN `type` ON `product`.t_id = `type`.t_id WHERE `product`.t_id = '$type' AND  `product`.p_id NOT IN(SELECT `p_id` FROM `gb_list` INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE $today BETWEEN `gb`.s_date AND `gb`.e_date);");
                                } else {
                                    $c_p = $db->query("SELECT * FROM (`product` INNER JOIN `money` ON `product`.m_id = `money`.m_id) INNER JOIN `type` ON `product`.t_id = `type`.t_id WHERE  `product`.p_id NOT IN(SELECT `p_id` FROM `gb_list` INNER JOIN `gb` ON `gb_list`.g_id = `gb`.g_id WHERE $today BETWEEN `gb`.s_date AND `gb`.e_date);");
                                }

                                foreach ($c_p as $p) {
                                    $p_id = $p['p_id'];
                                ?>
                                    <tr>
                                        <td><?php echo $p_id ?></td>
                                        <td><?php echo $p['p_name'] ?></td>
                                        <td><?php echo $p['price'] ?><?php echo $p['sign'] ?> </td>
                                        <td><?php echo $p['type'] ?></td>
                                        <td><?php echo $p['cate'] ?></td>
                                        <?php
                                        if ($today < $list['e_date']) { ?>
                                            <td>
                                                <a id="add" href="?g_id=<?= $g_id ?>&add=<?= $p['p_id'] ?> ">✚</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div class="col-sm-6" style="overflow-y: auto;height:60vh">
                            <table class="table table-striped">
                                <caption style="caption-side:top">GROUP BUY LIST</caption>
                                <tr>
                                    <th>ID product</th>
                                    <th>Name product</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <?php
                                $b2 = $db->query("SELECT * FROM ((`product` INNER JOIN `type` ON `product`.t_id = `type`.t_id) INNER JOIN `money` ON `product`.m_id =  `money`.m_id) INNER JOIN `gb_list` ON `gb_list`.p_id = `product`.p_id  WHERE `g_id` = '$g_id'");
                                foreach ($b2 as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['p_id'] ?></td>
                                        <td><?php echo $row['p_name'] ?></td>
                                        <td><?php echo $row['price'] ?><?php echo $row['sign'] ?> </td>
                                        <td><?php echo $row['type'] ?></td>
                                        <td><?php echo $row['cate'] ?></td>

                                        <?php
                                        if ($today < $list['e_date']) { ?>
                                            <td>
                                                <a href="?g_id=<?= $g_id ?>&rmv=<?= $row['p_id'] ?> ">✘</a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<?php require_once 'view/end.php'; ?>
<script type="text/javascript">
    $(document).ready(function() {
        ///////
        var startDate;
        var endDate;
        $("#date_picker1").datepicker({
            dateFormat: 'dd-mm-yy'
        })
        ///////
        ///////
        $("#date_picker2").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        ///////
        $('#date_picker1').change(function() {
            startDate = $(this).datepicker('getDate');
            $("#date_picker2").datepicker("option", "minDate", startDate);
        })

        ///////
        $('#date_picker2').change(function() {
            endDate = $(this).datepicker('getDate');
            $("#date_picker1").datepicker("option", "maxDate", endDate);
        })

    });
</script>