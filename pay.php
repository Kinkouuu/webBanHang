<?php
require_once("template/header.php");
?>
<h2>Payment page</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 ">
            <div class="pay_info">
            <a href="cart.php">Back to cart</a>
                <div class="row">
                    <span>Total product:</span>
                    <span>Provisional:</span>
                    <span>Transport fee:</span>
                </div>
                <div class="voucher d-flex flex-row ">
                    <textarea class="form-control" style="height: 30px; margin-right:1em" aria-label="With textarea" placeholder="Enter discount code"></textarea>
                    <button type="button" class="btn btn-primary"><i class="fa-sharp fa-solid fa-check"></i></button>
                </div>
                <span>Total: VND</span>
            </div>


            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" >
                <label class="form-check-label" for="exampleRadios1">
                    Payment on Delivery(COD)
                </label>
            </div>
			            <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" checked >
                <label class="form-check-label" for="exampleRadios2">
                    Bank transfer
                </label>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Thong tin tai khoan ngan hang shop
                    </div>
                </div>

            </div>
            <button type="button" class="btn btn-outline-primary" style="width: 60%;">ORDER</button>
            
        </div>

    </div>
</div>
<?php
require_once("template/footer.php");
?>