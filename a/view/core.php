<?php
//Start a new session

session_start();

//Check the session start time is set or not
if(!isset($_SESSION['start']))
{
    //Set the session start time
    $_SESSION['start'] = time();
}
//Check the session is expired or not
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] >3600000)) {
    //Unset the session variables
    session_unset();
    //Destroy the session
    session_destroy();
    echo '<script>alert("Your session is expired.");window.location = "https:localhost/ez/a/index.php";</script>';
}

?>