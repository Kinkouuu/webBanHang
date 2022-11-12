<?php require_once 'head.php'; ?>
<?php
if (isset($_GET['del'])) {
   $iddel = mget('del');
   $db->exec("UPDATE `product` SET `remain` = '0' WHERE `p_id` = '$iddel'");
   echo '<script>alert("Đã xoá ' . $iddel . '"); window.location = "product.php";</script>';
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
      <div class="card-body p-0">
         <table class="table table-striped projects">
            <thead>
               <tr>
                  <th style="width: 1%">
                     #
                  </th>
                  <th style="width: 20%">
                     Picture
                  </th>
                  <th style="width: 20%">
                     Name
                  </th>
                  <th style="width: 5%">
                     Category
                  </th>
                  <th style="width: 5%">
                     Type
                  </th>
                  <th style="width: 5%">
                     Code
                  </th>
                  <th style="width: 15%">
                     Specification
                  </th>
                  <th style="width: 15%">
                     Price
                  </th>
                  <th style="width: 5%">
                     Remain
                  </th>
                  <th style="width: 20%">
                     Factory
                  </th>
                  <th style="width: 25%">
                     Review
                  </th>
               </tr>
            </thead>
            <tbody>
               <?php
               $product = $db->query("SELECT * FROM `product` INNER JOIN `type` ON product.type = type.t_id ORDER BY `p_id` DESC");
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

                     <td>
                        <?= $pro['spec']; ?>
                     </td>
                     <td>
                        <?= $pro['price']; ?> VND
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
                           Edit
                        </a>
                        <a class="btn btn-danger btn-sm" href="?del=<?= $pro['p_id']; ?>">
                           Delete
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
<?php require_once 'end.php'; ?>