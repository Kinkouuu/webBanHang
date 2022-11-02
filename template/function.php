<?php
//function cua web
function locdata($var)
    {
        $data = trim(addslashes(htmlspecialchars($var)));
        return $data;
    } // anti sql injection
    
function mget($name) {
    if (isset($_GET[$name])) {
        return locdata($_GET[$name]);
    } else {
        return "";
    }
}

//get data from post method
function mpost($name) {
    if (isset($_POST[$name])) {
        return locdata($_POST[$name]);
    } else {
        return "";
    }
}

function info_admin($a, $b) {
    global $db;
    $c = $db->query("SELECT * FROM `admin` WHERE `id` = '$a'")->fetch();
    return $c[$b];
}

function setting($text) {
    global $db;
    $cd = $db->query("SELECT * FROM `setting` WHERE `id` = '1'")->fetch();
    return html_entity_decode($cd[$text]);
}

function hashp($inp) {
    return md5($inp);
}

?>