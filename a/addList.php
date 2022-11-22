<?php require_once 'view/head.php';
?>
<?php
$g_id = $_GET['g_id'];
$list = $db->query("SELECT * FROM `gb` WHERE `g_id` = '$g_id'")->fetch();

if(isset($_GET['add'])){
    $a_id =  mget('add');
    // echo $a_id;
    // echo $g_id;
    $count = $db->query("SELECT * FROM `gb_list` WHERE `g_id` = '$g_id' AND `p_id` = '$a_id'")->rowCount();
    if($count == 0){
        $db->exec("INSERT INTO `gb_list` (`g_id`, `p_id`) VALUES ( '$g_id', '$a_id');");
        echo '<script> window.location = "?g_id='. $g_id .' "; </script>';
    }else{
        echo '<script>alert("This product has been added in group by list");window.location = "?g_id='. $g_id .' "; </script>';
    }
    
}
if(isset($_GET['rmv'])){
    $r_id =  mget('rmv');
    // echo $r_id;
    // echo $g_id;
    $db ->exec("DELETE FROM `gb_list` WHERE `g_id` = '$g_id' AND `p_id` = '$r_id';"); 
}
?>

<div class="container-fluid m-2">
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3 d-flex">
                <label for="" class="col-sm-6">ID group by: </label>
                <div class="col-sm-5">
                <input type="text" disabled value="<?= $g_id ?>">
                </div>
            </div>
            <div class="col-sm-3 d-flex">
                <label for="" class="col-sm-6">From</label>
                <div class="col-sm-5">
                <input type="text" name = "s_day" id="date_picker1" value="<?= $list['s_date']?>">
                </div>
            </div>
            <div class="col-sm-3 d-flex">
                <label for="" class="col-sm-6">To</label>
                <div class="col-sm-5">
                <input type="text" name = "e_day" id="date_picker2" value="<?= $list['e_date']?>">
                </div>
            </div>
            <!-- <div class="col-sm-3">
            <button type="submit" name="save" class="btn btn-success">✔</button>
            </div> -->
            
            <!-- table view -->
            <div class="col-sm-12 m-1">
            <form method="POST">
    <select class="select-type" name="type" aria-label="Default select example">
        <option selected value="">All type product</option>
        <?php
        $type = $db->query("SELECT * FROM `type` WHERE `type`.type != '' order by `t_id` ASC");
        foreach ($type as $t) {
        ?>
            <option value="<?= $t['type'] ?>"><?php echo $t['type'] ?></option>
        <?php } ?>
    </select>
    <input type="submit" name="submit" value="✔">
    <div class="row">

        <div class="col-sm-6" style="overflow-y: auto;height:60vh">
            <table class="table table-striped">
            <caption  style="caption-side:top">ALL PRODUCTS</caption>
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
                    $product = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON `product`.t_id = `type`.t_id) INNER JOIN `money` ON `product`.m_id =  `money`.m_id WHERE `type` = '$type' ORDER BY `p_id`  ASC");
                } else {
                    $product = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON `product`.t_id = `type`.t_id) INNER JOIN `money` ON `product`.m_id =  `money`.m_id ORDER BY `p_id`  DESC");
                }

                foreach ($product as $p) {
                ?>
                    <tr>
                        <td><?php echo $p['p_id'] ?></td>
                        <td><?php echo $p['p_name'] ?></td>
                        <td><?php echo $p['price'] ?><?php echo $p['sign'] ?> </td>
                        <td><?php echo $p['type'] ?></td>
                        <td><?php echo $p['cate'] ?></td>
                        <td>
                            <a id = "add" href="?g_id=<?= $g_id?>&add=<?= $p['p_id'] ?> ">✚</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="col-sm-6" style="overflow-y: auto;height:60vh">
            <table class="table table-striped">
            <caption  style="caption-side:top">GROUP BY LIST</caption>
                <tr>
                    <th>ID product</th>
                    <th>Name product</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>&nbsp;</th>
                </tr>
                <?php
                $list = $db->query("SELECT * FROM ((`product` INNER JOIN `type` ON `product`.t_id = `type`.t_id) INNER JOIN `money` ON `product`.m_id =  `money`.m_id) INNER JOIN `gb_list` ON `gb_list`.p_id = `product`.p_id  WHERE `g_id` = '$g_id'");
                foreach ($list as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['p_id'] ?></td>
                        <td><?php echo $row['p_name'] ?></td>
                        <td><?php echo $row['price'] ?><?php echo $row['sign'] ?> </td>
                        <td><?php echo $row['type'] ?></td>
                        <td><?php echo $row['cate'] ?></td>
                        <td>
                            <a href="?g_id=<?= $g_id?>&rmv=<?= $row['p_id'] ?> ">✘</a>
                        </td>
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
        ////////////////
    });

</script>