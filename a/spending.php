<?php require_once 'view/head.php'; ?>

<!-- Content Header (Page header) -->
<script src="table2excel.js"></script>
<?php 
$users = $db->query("SELECT * FROM `user` ORDER BY `u_id` ASC");
$user = $db->query("SELECT DISTINCT(u_id) FROM `order`");
$n_u = 0; // số người dùng
$n_o = 0; // số đơn hàng
$n_p = 0; // số sản phẩm đã mua
$n_pf = 0; // số tiền phụ phí
$n_df = 0; // số tiền ship
$n_d= 0; // số tiền giảm
$n_m = 0; // số tiền hàng
$total = 0 ; //số tiền đã chi ra
?>

<!-- Main content -->
<section class="content">
<strong>Registered users: <?php echo $users->rowCount() ?></strong><br>

<strong>Number of users have ordered: <?php echo $user->rowCount() ?></strong> 
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User's spending</h3> <br>

            <div class="card-tools d-flex">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="d-flex justify-content-between">
            <form class="select d-flex" method="GET">
                <p>User have ordered: <input type="number" min = "0" name="times"> times </p>
                <input type="submit" name="submit" value="✔">
            </form>
            <button id="export">Export to CSV</button>
            </div>
            <?php if (isset($_GET['submit'])){
                $times = $_GET['times'];
            }else{
                $times ='';
            }
             ?>
            <table class="table table-striped projects" id = "dataList">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 10%">
                            User name
                        </th>
                        <th style="width: 10%">
                            Phone number
                        </th>
                        <th>
                            Order number
                        </th>
                        <th>
                            Quantity of products purchased
                        </th>
                        <th>
                            Processing fee
                        </th>
                        <th>
                            Delivery fee
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            Total price of product
                        </th>
                        <th>
                            Total purchase amount
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach ($users as $user) {
                        $u_id = $user['u_id'];
                        // echo $u_id. " ";
                        $bought = $db->query("SELECT count(DISTINCT `order`.ID) as sd, `user`.u_id FROM `order`,`user` WHERE `order`.u_id = `user`.u_id AND `user`.u_id = $u_id");
                            foreach ( $bought as $buy){
                                if($buy['sd'] == $times || $times == ''){ // lay danh sanh nguoi mua $times lan
                                    // echo $buy['u_id']. " = " .$buy['sd'] ." , ";
                                    $uid = $buy['u_id']; // lay u_id cua nhung nguoi mua $times lan
                                    $n_u += 1;
                                    $ds = $db->query("SELECT `user`.*, count(DISTINCT `ID`) as sd,count(`order`.o_id) as sdh, sum(`amount`) as ssp, sum(`amount` * `d_price` ) as sth from `details`, `order`,`user` WHERE `details`.o_id = `order`.o_id AND `order`.u_id = `user`.u_id AND `user`.u_id = '$uid'");
                                        foreach($ds as $tt){
                                            $discount = $db->query("SELECT sum(`sale`.discount) as discount FROM `sale` INNER JOIN `order` ON `sale`.s_id = `order`.s_id WHERE `order`.u_id = $u_id")->fetch();
                                            // echo $tt['u_id'] . " = " . $discount['discount']. ","  ; ?>
                    <tr>
                        <td>
                            <?= $tt['u_id'] ?>
                        </td>
                        <td>
                            <?= $tt['f_name']. " " . $tt['l_name']?>
                        </td>
                        <td>
                            <?= $tt['phone'] ?>
                        </td>
                        <td>
                            <?= $tt['sd'];
                            $n_o += $tt['sd']?>
                        </td>
                        <td>
                            <?=  0 + $tt['ssp'];
                            $n_p += $tt['ssp']?>
                        </td>
                        <td>
                            <?= $tt['sd'] * 350000;
                            $n_pf += $tt['sd'] * 350000?>
                        </td>
                        <td>
                            <?= $tt['sdh'] * 40000;
                            $n_df +=$tt['sdh'] * 40000
                            ?>
                        </td>
                        <td>
                            <?= 0+$discount['discount'];
                            $n_d += $discount['discount']
                            ?>
                        </td>
                        <td>
                            <?= 0+$tt['sth'];
                            $n_m += $tt['sth']?>
                        </td>
                        <td>
                            <?= $tmp = 0+$tt['sth'] + $tt['sd'] * 350000 + $tt['sdh'] * 40000 - $discount['discount'];
                                $total += $tmp
                            ?>
                        </td>
                    </tr>

                                <?php }
                                }
                                
                            }
                        }
                        ?>
                    <tr class="table-primary" >
                        <td colspan="3">Total</td>
                        <td>
                            <?= $n_o ?>
                        </td>
                        <td>
                            <?= $n_p?>
                        </td>
                        <td>
                            <?= $n_pf?>
                        </td>
                        <td>
                            <?= $n_df?>
                        </td>
                        <td>
                            <?= $n_d ?>
                        </td>
                        <td>
                            <?= $n_m ?>
                        </td>
                        <td>
                            <?= $total ?>
                        </td>
                    </tr>
                    <tr class="table-success">
                        <td colspan="3">Averange</td>
                        <td>
                            <?= round($n_o/$n_u,2) ?>
                        </td>
                        <td>
                            <?= round($n_p/$n_u,2) ?>
                        </td>
                        <td colspan="4">
                        </td>
                        <td>
                        <?= round($total/$n_u,2) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
</div>
<script>
    document.getElementById('export').addEventListener('click', function(){
        var table2excel = new Table2Excel();
  table2excel.export(document.querySelectorAll("#dataList"));
    });
</script>
<!-- /.content-wrapper -->
<?php require_once 'view/end.php'; ?>