<?php
    require_once 'template/header.php';
?>

<div id = "wrapper" style="background-image: url('#'); background-repeat: no-repeat;background-size: cover;">
        <form action="./process/xl_signin.php" id="form-login" method="POST">
            <h1 class="form-heading">Sign in your account</h1>
            <div class="form-group">
            
                <input type="text" class="form-input" name ="phone" placeholder="Phone number" require >
            </div>
            <div class="form-group">
                
                <input type="password" class="form-input" name = "inPass" placeholder="Password" require>
                <div class ="eye">
                    <i class="fa-solid fa-eye" style="color: white;"></i>
                </div>
            </div>
            <?php
            if (isset($_GET['message'])){
        echo '<small class ="form-text" style="color:red;">' . $_GET['message'] . '</small>';
    }
    ?>
            <input type="submit" value="Sign In" class="form-submit" name="btnLogIn">
            <a href="signup.php" class="sign-log">Create a new account</a>
        </form>
    </div>
<?php
    require_once("template/end.php");
?>