<h1>Start Soucing</h1>
<style>
    .inp{
    width: 85%;
    margin-bottom: 5px;
}
.ip{
    width: 60%;
    margin-top: 5px;
}
.form-label{
    margin-right: 5px;
}
</style>
<form action="./process/sendMail.php" id="soucing" method="POST">
    <h4>Product infomation: </h4>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <label for="n_product" class="form-label">Name: </label>
                <input type="text" class="inp" name="n_product" id="n_product" required>
            </div>
            <div class="col-md-4 ">
                <label for="brand" class="form-label">Brand: </label>
                <input type="text" class="inp" name="brand" id="brand" required>
            </div>
            <div class="col-md-4 d-flex">
                <label for="upfile" class="form-label">Link image: </label>
                <input type="text" class="inp" name="link" style ="width:75%;" required>
            </div>
        </div>
        <div class="col-12 d-flex align-items-center">
            <label class="form-label">Specifications:</label>
            <textarea class="form-control1" style="width: 90%; margin:5px" name="spec" rows="3"></textarea>
        </div>
        <div class="col-12 d-flex align-items-center">
            <label class="form-label">Product inquiry:</label>
            <textarea class="form-control1" style="width: 90%; margin:5px" name="inquiry" rows="3"></textarea>
        </div>
    </div>

    <div class="row">
    <div class="col-md-3">
            <label class="form-label" for="">Desired price: </label>
            <input type="text" class="ip" name="price" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="">Number of product: </label>
            <input type="text" class="ip" name="number" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="">Products have deposited: </label>
            <input type="text" class="ip" name="deposit" style="width:50%;" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="">Desired opening time: </label>
            <input type="date" class="ip" name="time" style="width:50%;">
        </div>

    </div>

    <h4>Customers Information: </h4>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="">First name: </label>
            <input type="text" class="ip" name="f-name" required>
        </div>
        <div class="col-3">
            <label class="form-label" for="">Last name: </label>
            <input type="text" class="ip" name="l-name" required>
        </div>
        <div class="col-3">
            <label class="form-label" for="">Email: </label>
            <input type="email" class="ip" name="email" required>
        </div>
        <div class="col-3">
            <label class="form-label" for="">Phone number: </label>
            <input type="text" class="ip" name="phone" required>
        </div>
    </div>


    <div class="me-0">
        <input type="submit" class="btn btn-success" value="SUBMIT" class="" name="btnSend">
    </div>
</form>