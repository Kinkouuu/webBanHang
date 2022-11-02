<?php
    require_once 'template/header.php';

?>

<div id="wrapper" style="background-image: url('img/background.jpg'); background-repeat: no-repeat;background-size: cover;">
        <form action="process/xl_signup.php" id="form-signup" method="POST">
            <h1 class="form-heading">Create your account</h1>
            <div class="form-group">
                <input type="text" class="in-form" name="f_name" placeholder="First name" required  >
                <input type="text" class="in-form" name="l_name" placeholder="Last name" required  >
            </div>
            <div class="form-group">
                <input type="text" class="form-input" name="phone"  id ="phone" placeholder="Your phone number" required >
                <small id="phoneHelp" class="form-text"></small>
            </div>
            <div class="form-group">
                
                <input type="password" class="form-input" name ="inPass" placeholder="Password" required > 
                <div class="eye">
                    <i class="fa-solid fa-eye" style="color: white;"></i>
                </div>
            </div>
            <div class="form-group">
                
                <input type="password" class="form-input" name="rePass" placeholder="Retype password" required >
                <div class="eye">
                    <i class="fa-solid fa-eye" style="color: white;"></i>
                </div>
            </div>
            <?php
            if (isset($_GET['fail'])){
        echo '<small class ="form-text" style="color:red;">' . $_GET['fail'] . '</small>';
    }
    ?>
            <span style="color: white;">Adress:</span>
            <div class="form-group">
                <input type="text" class="in-form" name="city" placeholder="City/Province" required  >
                <input type="text" class="in-form" name="district" placeholder="District" required  >
            </div>
            <div class="form-group">
                <input type="text" class="in-form" name="ward" placeholder="Ward/Village" required  >
                <input type="text" class="in-form" name="street" placeholder="Street" required  >
            </div>
            <div class="form-group">
                <input type="text" class="form-input" name="no" placeholder="Building/No." required >
            </div>
            <input type="submit" value="Sign Up" class="form-submit" name ="btnSignUp">
            <a href="signin.php" class="sign-log">Do you have an account?</a>
            
        </form>
    </div>

<?php
    require_once("template/end.php")
?>