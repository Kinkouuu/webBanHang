<?php
require_once("template/header.php");
require_once("template/nav.php");

?>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-6 ">
            <?php
            $p_id = (int) mget('p_id');
            $product = $db->query("SELECT * FROM `product`  INNER JOIN `money` ON product.m_id = money.m_id WHERE `p_id` = $p_id")->fetch();
            $sold = $db->query("SELECT sum(amount) as sold FROM `details` WHERE `p_id` = $p_id")->fetch();
            ?>


            <div class="images">
                <img src="<?= $product['pics'] ?>" class="d-block w-100" alt="...">
            </div>

        </div>
        <div class="col-md-3 ">

            <form action="process/xl_addcart.php" method="POST">
                <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
                <input type="hidden" name="remain" value="<?php echo $product['remain']; ?>">

                <p class="name_product"><strong>Name: </strong> <?php echo $product['p_name'] ?></p>
                <p class="price_product"> <strong>Price: </strong>
                    <?php
                    if ($product['sign'] == 'VND') {
                        echo $product['price'] * $product['ex'] . ' VND';
                    } else {
                        echo $product['price'] ?> <?php echo $product['sign'] . '≈' . $product['price'] * $product['ex'] . ' VND';
                                                            }

                                                                ?>
                </p>



                <div class="d-flex justify-content-start">
                    <p><strong>Amount: </strong></p>
                    <div class="ms-1 me-1">
                        <input aria-label="quantity" class="quanty_product" max="99999" min="1" name="unit" type="number" value="1">
                    </div>
                    <!-- <p> / <?php echo $product['remain'] ?></p> -->

                </div>
                <div class="">
                <p><strong>Odered:</strong> <?php echo $sold['sold']?></p>       
                </div>

                <input type="submit" name="addCart" class="btn btn-outline-primary" value="Add to cart">
                <p><strong>Specifications: </strong>
                    <?php
                    $str = $product['spec'];
                    $dump = explode('-', $str);
                    for ($x = 0; $x < sizeof($dump); $x++) {
                        echo $dump[$x] . "<br />";
                    }
                    ?>
                </p>

            </form>
            <a href="<?= $product['video']; ?>"><strong>Video reviews.</strong></a>
        </div>
    </div>

</div>


<?php
require_once("template/footer.php");
?>