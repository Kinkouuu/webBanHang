<?php require_once 'view/head.php'; ?>
<?php
if (isset($_GET['del'])) {
   $iddel = mget('del');
   $db->exec("UPDATE `product` SET `remain` = '0' WHERE `p_id` = '$iddel'");
   echo '<script>alert("Đã reset sản phẩm ' . $iddel . '"); window.location = "product.php";</script>';
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">

   <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
   <!-- Default box -->
   <div class="card">
      <div class="card-header">
         <h3 class="card-title">Product | <a href="addproduct.php">ADD</a></h3>
         <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
               <i class="fas fa-minus"></i>
            </button>
         </div>
      </div>
      <div class="card-body p-0 overflow-auto">
         <table class="table table-striped projects">
            <thead>
               <tr>
                  <th style="width: 1%">
                     #
                  </th>
                  <th style="width: 15%">
                     Picture
                  </th>
                  <th style="width: 10%">
                     Name
                  </th>
                  <th style="width: 3%">
                     Category
                  </th>
                  <th style="width: 3%">
                     Type
                  </th>
                  <th style="width: 3%">
                     Code
                  </th>
                  <th style="width: 35%">
                     Specification
                  </th>
                  <th style="width: 10%">
                     Price
                  </th>
                  <th style="width: 10%">
                  Exchange
               </th>
                  <th style="width: 5%">
                     Remain
                  </th>
                  <th style="width: 5%">
                     Factory
                  </th>
                  <th style="width: 10%">
                     Review
                  </th>
               </tr>
            </thead>
            <tbody>
               <?php
               $product = $db->query("SELECT * FROM (`product` INNER JOIN `type` ON product.t_id = type.t_id) INNER JOIN `money` ON product.m_id = money.m_id ORDER BY `p_id` DESC");
               foreach ($product as $pro) {
                  $id = $pro['f_id'];
               ?>
                  <tr>
                     <td>
                        <?= $pro['p_id']; ?>
                     </td>
                     <td>
                        <img src="<?= $pro['pics']; ?>" alt="" style="width: 100%;">
                     </td>
                     <td>
                        <?= $pro['p_name']; ?>
                     </td>
                     <td>
                        <?= $pro['cate']; ?>
                     </td>
                     <td>
                        <?= $pro['type']; ?>
                     </td>
                     <td>
                        <?= $pro['product_code']; ?>
                     </td>

                     <td style="line-height: 1 ;">
                        <?= $pro['spec']; ?>
                     </td>
                     <td>
                        <?= $pro['price'];  ?> <?= $pro['sign']; ?>
                     </td>
                     <td>
                        <?= $pro['price']*$pro['ex'] ; ?> VND
                     </td>
                     <td>
                        <?= $pro['remain']; ?>
                     </td>
                     <td>
                        <?php
                        $factorys = $db->query("SELECT * FROM `factory` WHERE `f_id` = '$id'");
                        foreach ($factorys as $factory) {
                           echo $factory['f_name'];
                        }
                        ?>
                     </td>
                     <td>
                        <?= $pro['video']; ?>
                     </td>
                     <td class="project-actions text-center">
                        <a class="btn btn-primary btn-sm" href="p_edit.php?p_id=<?= $pro['p_id']; ?>">
                        ✎
                        </a>
                        <a class="btn btn-danger btn-sm" href="?del=<?= $pro['p_id']; ?>">
                        ✖
                        </a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once 'view/end.php'; ?>