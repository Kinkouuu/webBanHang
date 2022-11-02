<?php
    require_once "./template/config.php";
?>
<h3>New Product</h3>
<div class="row">
<?php
$new_pro = $db->query("SELECT * FROM `product` ORDER BY p_id DESC limit 4");
if ($new_pro -> rowCount() > 0){
    foreach ($new_pro as $product){
        $p_id = $product['p_id'];
        $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
?>

    <div class="col-md-3 ms-aut">
    
        <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">        
            <img src="<?= $product['pics']; ?>" alt="" style="width: 100%; height:auto;">
            
            <p class="name_product"><?php echo $product['p_name']?></p>
            <p class="price_product"><?php echo $product['price']?> VND</p>
            <p>Sold: <?php echo $sold['sold']?></p>
        </a>
        
    </div>
    <?php }}
    else {
        echo "<h3>There are currently no products for sale.</h3>";
    } ?>
</div>

<h3>Ongoing Group-Buy</h3>
<div class="row">
<?php
$new_pro = $db->query("SELECT * FROM `product` ORDER BY p_id ASC limit 20");
if ($new_pro -> rowCount() > 0){
    foreach ($new_pro as $product){
        $p_id = $product['p_id'];
        $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
?>

    <div class="col-md-3">
    
        <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">        
            <img src="<?= $product['pics']; ?>" alt="" style="width: 100%; height:auto;">
            
            <p class="name_product"><?php echo $product['p_name']?></p>
            <p class="price_product"><?php echo $product['price']?> VND</p>
            <p>Sold: <?php echo $sold['sold']?></p>
        </a>
        
    </div>
    <?php }}
    else {
        echo "<h3>There are currently no products for sale.</h3>";
    } ?>
</div>
