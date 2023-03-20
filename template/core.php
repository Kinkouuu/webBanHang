<?php
require_once ("header.php");
if (isset($_SESSION['user'])) {
        $u_id =$_SESSION['user'];
        // echo $u_id;
}else{
  header("Location:signin.php");
}

?>