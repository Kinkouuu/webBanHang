<?php
require_once "template/header.php";
require_once "template/core.php";
require_once "template/config.php";
require_once "template/nav.php";
require_once "menu.php";
?>
<div class="col-12 mt-5 ms-5">
    <div class="row">
        <?php
        if (isset($_GET['text'])) {
            $text = $_GET['text'];
                $info = $db->query("SELECT * FROM `product` INNER JOIN `money` ON `product`.m_id = `money`.m_id WHERE p_id = '$text' OR p_name LIKE '%$text%'");
                    foreach ($info as $product) {
                        $p_id = $product['p_id'];
                        $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
        ?>


<div class="col-md-3 m-auto">
    
    <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">        
        <img src="<?= $product['pics']; ?>" alt="" style="width: 100%; height:auto;">
        
        <p class="name_product"><?php echo $product['p_name']?></p>
        <p class="price_product">
        <?php
                                if($product['sign'] == 'VND'){
                                    echo $product['price']*$product['ex']. ' VND'; 

                                }else{
                                echo $product['price'] ?>  <?php echo $product['sign']. '≈' .$product['price']*$product['ex']. ' VND'; 
                                }
                                ?> </p>
        <p>Sold: <?php echo $sold['sold']?></p>
    </a>
    
</div>

        <?php
                    }
                }
            // }

        require_once "template/footer.php";
        ?>
    </div>
</div>