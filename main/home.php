<?php
    require_once "./template/config.php";
?>
<h3>Sản phẩm mới</h3>
<div class="row">
<?php
$items = !empty($_GET['items'])?$_GET['items']:6;
$page = !empty($_GET['page'])?$_GET['page']:1; //trang hien tai 
$offset = ($page - 1) * $items;
$new_pro = $db->query("SELECT * FROM `product` INNER JOIN `money` ON `product`.m_id = `money`.m_id WHERE `product`.remain >0  ORDER BY `p_id` DESC ");
$ssp = $db->query("SELECT * FROM `product` WHERE remain > 0")->rowCount();
$st = ceil($ssp/$items);

if ($new_pro -> rowCount() > 0){
    foreach ($new_pro as $product){
        $p_id = $product['p_id'];
        //sl hang ban duoc thanh cong
        //  $sold = $db->query("SELECT sum(amount) as sold FROM `details` INNER JOIN `order` ON `details`.o_id = `order`.o_id WHERE `details`.p_id = $p_id AND `order`.status = 'Đã giao hàng'")->fetch();
        $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
?>

    <div class="col-md-2 m-auto">
    
        <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">        
            <img src="<?= $product['pics']; ?>" alt="" style="width: 100%; height:auto;">
            
            <p class="name_product"><?php echo $product['p_name']?></p>
            <p class="price_product"><?php echo $product['s_price']?> VND</p>
            <p>Đã bán: <?php echo $sold['sold']?> sản phẩm</p>
        </a>
        
    </div>
    <?php }}
    else {
        echo "<h3>There are currently no products for sale.</h3>";
    } 
?>
</div>
<div class ="d-flex justify-content-center ">
<?php for($num=1; $num <= $st;$num++){ // vong lap so trang
    if($num != $page){ // in dam trang hien tai
        if ($num > $page -3 && $num < $page +3){ 
        ?>
    
<a class="num_page"  href="?items=<?= $items ?>&page=<?= $num ?>"><?= $num ?></a>
<?php } }else{
    ?>
<a class="num_page" style ="background-color: black;color: white" href="#"><?= $num ?></a>
<?php } }?>
</div>
