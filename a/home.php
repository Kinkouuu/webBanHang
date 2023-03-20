
<?php 
require_once 'view/head.php';
require_once 'view/sidebar.php';
 ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `product`")->rowcount(); ?></h3>

                <p>Product</p>
              </div>
              <a href="product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `user`")->rowcount(); ?></h3>

                <p>User Registrations</p>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
			<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `order`")->rowcount(); ?></h3>

                <p>Order</p>
              </div>
              <a href="order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-pink">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `sale`")->rowcount(); ?></h3>

                <p>Voucher Discount</p>
              </div>
              <a href="sale.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">

                <h3><?php echo $db->query("SELECT * FROM `type`")->rowcount(); ?></h3>

                <p>Category Type</p>
              </div>
              <a href="cate_type.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `factory`")->rowcount(); ?></h3>

                <p>Supply Factory</p>
              </div>
              <a href="fact.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `money`")->rowcount(); ?></h3>

                <p>Currency Exchange</p>
              </div>
              <a href="money.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `statist`")->rowCount(); ?></h3>

                <p>Statisticial</p>
              </div>
              <a href="statist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `statist`")->rowCount(); ?></h3>
                <p>User's Spending</p>
              </div>
              <a href="spending.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo $db->query("SELECT * FROM `gb`")->rowcount(); ?></h3>
                <p>Start Sourcing</p>
              </div>
              <a href="sourcing.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'view/end.php'; ?>