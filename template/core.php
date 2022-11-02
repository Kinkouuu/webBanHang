<?php
require_once 'config.php';
require_once 'function.php';

if (isset($_SESSION['user'])) {
    $userdata = $db->query("SELECT * FROM `user` WHERE `u_id` = '" . $_SESSION['user'] . "' ")->fetch();
    if ($userdata == null) {
        session_unset();
        header("Location: index.php");
        exit;
    } else {
        $uid = $userdata['u_id'];
    }
}

?>