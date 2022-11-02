<?php require_once 'head.php'; ?>
<?php
    if (isset($_GET['del'])) {
        $iddel = mget('del');
        $db->exec("DELETE FROM `product` WHERE `p_id` = '$iddel'");
        echo '<script>alert("Đã xoá ' . $iddel . '"); window.location = "product.php";</script>';
    }
?>
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Product</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Product | <a href="addproduct.php">Thêm</a></h3>
            <div class="card-tools">
               <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
               <i class="fas fa-minus"></i>
               </button>
               <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
               <i class="fas fa-times"></i>
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
                        Name
                     </th>
					  <th style="width: 10%">
                        Product Category
                     </th>
                     <th style="width: 5%">
                        Type
                     </th>
					  <th style="width: 5%">
                        Product Code
                     </th>
                     <th style="width: 15%">
                        Picture
                     </th>
                     <th style="width: 15%">
                        Spec
                     </th>
                     <th style="width: 20%">
                        Price
                     </th>
                     <th style="width: 5%">
                        Remain
                     </th>
                     <th style="width: 20%">
                        Factory
                     </th>
					  <th style="width: 20%">
                        Review
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $product = $db->query("SELECT * FROM `product` ORDER BY `p_id` DESC");
                     foreach ($product as $pro) { 
						 $id = $pro['f_id'];
                     ?>
                  <tr>
                     <td>
                        <?= $pro['p_id']; ?>
                     </td>
                     <td>
                        <?= $pro['p_name']; ?>
                     </td>
					  <td>
                        <?= $pro['p_cat']; ?>
                     </td>
                     <td>
                        <?= $pro['type']; ?>
                     </td>
					  <td>
                        <?= $pro['product_code']; ?>
                     </td>
                     <td>
                        <?= $pro['pics']; ?>
                     </td>
                     <td>
                        <?= $pro['spec']; ?>
                     </td>
                     <td>
                        <?= $pro['price']; ?>
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
                        <?= $pro['link']; ?>
                     </td>
                     <td class="project-actions text-right">
						 <a class="btn btn-primary btn-sm" href="edit.php?p_id=<?= $pro['p_id']; ?>">
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