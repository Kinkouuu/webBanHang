<?php
    require_once "./template/config.php";
?>

<?php
if (isset($_GET['action'])) {
    $tam = $_GET['action'];
} else {
    $tam = '';
}
?>
<h3>Product Category: <?= $tam ?></h3>
<div class="row">
<?php
$new_pro = $db->query("SELECT * FROM `product`,`type` WHERE product.type = type.t_id AND type.type = '$tam' ORDER BY p_id DESC limit 4");
if ($new_pro -> rowCount() > 0){
    foreach ($new_pro as $product){
        $p_id = $product['p_id'];
        $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
?>


    <div class="col-md-3 m-auto">
    
        <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">        
            <img src="a/<?= $product['pics']; ?>" alt="" style="width: 100%; height:auto;">
            
            <p class="name_product"><?php echo $product['p_name']?></p>
            <p class="price_product"> 
                <?php 
            if ($product['money'] == ''){
                echo $product['price'].' VND' ;
                }else{
                    echo $product['money'].' = ' .$product['price'].' VND' ;
                }
                ?>
                </p>
            <p>Sold: <?php echo $sold['sold']?></p>
        </a>
    </div>
    <?php }}
    else {
        echo "<h3>There are currently no products for sale.</h3>";
    } ?>
</div>
