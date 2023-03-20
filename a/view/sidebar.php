<?php
if (!isset($_SESSION['admin'])){

  echo '<script>alert("You must login with admin account");window.location = "http:/webshop/a/index.php";</script>';
}else{
  $a_id = $_SESSION['admin'];
}
?>
<aside class="main-sidebar sidebar-dark-primary bg-dark elevation-4">
  <!-- Brand Logo -->
  <a href="./home.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Control Panel</li>
        <li class="nav-item">
          <a href="./product.php" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p class="text">Product</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./users.php" class="nav-link">
            <i class="nav-icon far fa-circle text-primary"></i>
            <p class="text">User</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./order.php" class="nav-link">
            <i class="nav-icon far fa-circle text-success"></i>
            <p class="text">Order</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="sale.php" class="nav-link">
            <i class="nav-icon far fa-circle text-pink"></i>
            <p class="text">Voucher Discount</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="cate_type.php" class="nav-link">
            <i class="nav-icon far fa-circle text-purple"></i>
            <p class="text">Category Type</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="fact.php" class="nav-link">
            <i class="nav-icon far fa-circle text-orange"></i>
            <p class="text">Supply Factory</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="money.php" class="nav-link">
            <i class="nav-icon far fa-circle text-indigo"></i>
            <p class="text">Currency Exchange</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="statist.php" class="nav-link">
            <i class="nav-icon far fa-circle text-green"></i>
            <p class="text">Revenue Statistics</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="spending.php" class="nav-link">
            <i class="nav-icon far fa-circle text-gray"></i>
            <p class="text">User's Spending</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="sourcing.php" class="nav-link">
            <i class="nav-icon far fa-circle text-yellow"></i>
            <p class="text">Start Sourcing</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>