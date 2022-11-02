<?php require_once 'head.php'; ?>
<!-- Content Header (Page header) -->
<?php $db->exec("DELETE FROM `final"); ?>
<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Order</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Detail Ordered</li>
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
         <h3 class="card-title">
            Detail Ordered 
            <form method="post" action="download.php"> 
               <input type="submit" name="export" value="DOWNLOAD" />
            </form>
         </h3>
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
                     Order_id
                  </th>
                  <th style="width: 10%">
                     Name
                  </th>
                  <th style="width: 10%">
                     Phone
                  </th>
                  <th style="width: 10%">
                     Delivery Date
                  </th>
                  <th style="width: 15%">
                     prd_cat
                  </th>
                  <th style="width: 15%">
                     prd_type
                  </th>
                  <th style="width: 15%">
                     prd_id
                  </th>
                  <th style="width: 15%">
                     prd_name
                  </th>
                  <th style="width: 15%">
                     pp
                  </th>
                  <th style="width: 15%">
                     pdt_sold
                  </th>
                  <th style="width: 5%">
                     Quantity
                  </th>
                  <th style="width: 10%">
                     Delivery Fee
                  </th>
                  <th style="width: 10%">
                     Discount
                  </th>
                  <th style="width: 15%">
                     Address
                  </th>
                  <th style="width: 10%">
                     District
                  </th>
                  <th style="width: 10%">
                     City
                  </th>
                  <th style="width: 10%">
                     Total Cost
                  </th>
                  <th style="width: 10%">
                     Status
                  </th>
				   <th style="width: 5%">
                     Update Status
                  </th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $details = $db->query("SELECT * FROM `details` ORDER BY `o_id` ASC");
                  foreach ($details as $detail) { 
                  	$id = $detail['o_id'];
                  $p_id = $detail['p_id'];
                  ?>
               <tr>
                  <td>
                     <?php echo $detail['o_id']; ?>
                  </td>
                  <td>
                     <?php 
                        $orders = $db->query("SELECT * FROM `order` WHERE `o_id` = '$id' LIMIT 1");
                        foreach ($orders as $order) { 
                        	$s_id = $order['s_id'];
                        	echo $order['o_name'];
                        	$name = $order['o_name'];
							$ad = $order['adress'];
							$vardump = explode(', ', $ad);
							$add = $vardump[0];
							$district = $vardump[1];
							$city = $vardump[2];
							break;
                        }
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php 
                        echo $order['o_phone'];
                        $phone = $order['o_phone'];
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php 
                        
                        $time = $order['time'];
					  echo date('d/m/Y', $time + 16*24*60*60);
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php 
                        $products = $db->query("SELECT * FROM `product` WHERE `p_id` = '$p_id' LIMIT 1");
                        foreach ($products as $product) { 
                        	echo $product['p_cat'];
                        	$cat = $product['p_cat'];
							break;
                        }
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $product['type'];
					  $type = $product['type'];
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $product['product_code']; 
                        $code = $product['product_code'];
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $product['p_name']; 
                        $pname = $product['p_name'];
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $product['price']; 
                        $price = $product['price'];
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $detail['amount'];
					  $amount = $detail['amount'];?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $product['remain'];
					  $remain = $product['remain'];
					  ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     35k
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php 
					  $discount = 0;
                        $sales = $db->query("SELECT * FROM `sale` WHERE `s_id` = '$s_id' LIMIT 1");
                        foreach ($sales as $sale) { 
							$discount = $sale['discount'];
							echo $sale['discount'];
							break;
                        }
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $add ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $district; ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $city; ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php  
                        $total = $product['price'] * $detail['amount'] + 35000 - $discount;
					  if ($total < 0) {
						  $total = 0;
					  }
					  echo $total;
                        ?>
                  </td>
                  <!-- ......... -->
                  <td>
                     <?php echo $order['status']; ?>
                  </td>
                  <!-- ......... -->
				   
				    <td class="project-actions text-right">
							 <a class="btn btn-primary btn-sm" href="updateStatus.php?o_id=<?=$id; ?>">
								Update
							</a>
                    </td>
               </tr>
               <?php 
                  if (isset($_POST['update'])){
                  	$db->exec("INSERT INTO `final`(`oid`,`name`,`phone`,`deliverydate`,`prdcat`,`prdtype`,`prdid`,`prdname`,`pp`,`pdtsale`,`quantity`,`fee`,`discount`,`address`,`district`,`city`, `totalcost`) VALUES ('$id', '$name', '$phone', '$time', '$cat', '$type', '$code', '$pname', '$price', '$amount', '$remain', '35000', '$discount', '$add', '$district', '$city', '$total');");	
                  } } ?>
            </tbody>
         </table>
		  <form method="post"> 
               <input type="submit" name="update" value="UPDATE DETAIL ORDERED" />
            </form>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>