<?php
require_once "template/header.php";
require_once "template/core.php";
    require_once "template/config.php";
    require_once "template/nav.php";
    require_once "menu.php";

?>
<div class="col-12 mt-5 ms-5">
	<div class = "row">
<?php
if (isset($_POST['btnSearch'])) {
    $text = $_POST['text'];
    if ($text == '') {
        header("Location:index.php"); 
    }else{
        $info = $db->query("SELECT * from `product` where p_id = '$text' OR p_name LIKE '%$text%'");
        if ($info->rowCount() > 0) {
            foreach ($info as $product) {
?>
    

		<div class="col-md-3">
    
    <a href="./product.php?p_id=<?= $product['p_id']; ?>"  class="product" style="color: #010101;text-decoration: none;text-align: center;">
        
        <img src="<?= $product['pics']; ?>" alt="" style="max-width: 100%;">
        <p class="name_product"><?php echo $product['p_name']?></p>
        <p class="price_product"><?php echo $product['price']?> VND</p>
        <p>Sole: </p>
    </a>
    
</div>

<?php
            }
        }else{
            $alert = 'No product found'; 
            header("location: index.php?alert='$alert'");
            
    }
    } }
    require_once "template/footer.php";
?>
	</div>
</div>