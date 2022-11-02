<h3>Product category: Switch</h3>

<?php
require_once "./template/config.php";
?>

<div class="row">
    <?php
    $new_pro = $db->query("SELECT * FROM `product` WHERE `type` = 'switch' AND `remain` > 0 LIMIT 12");
    if ($new_pro->rowCount() > 0) {
        foreach ($new_pro as $product) {
            $p_id = $product['p_id'];
            $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
    ?>

            <div class="col-md-3" style="text-align: center;">

                <a href="./product.php?p_id=<?= $product['p_id']; ?>" class="product" style="color: #010101;text-decoration: none;">

                    <img src="<?= $product['pics'] ?>" alt="" style="max-width: 100%;">
                    <p class="name_product"><?php echo $product['p_name'] ?></p>
                    <p class="price_product"><?php echo $product['price'] ?></p>
                    <p>Sold: <?php echo $sold['sold']?></p>
                </a>


            </div>
    <?php }
    } else {
        echo "<h3>There are currently no products for sale.</h3>";
    }
    ?>
</div>