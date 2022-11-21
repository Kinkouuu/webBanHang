<?php
require_once("../template/config.php");
require_once("../carbon/autoload.php");

use Carbon\Carbon;
use Carbon\CarbonInterval;

if(isset($_POST['tgian'])){
    $tgian = $_POST['tgian'];
}else{
    $tgian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

if($tgian == '365'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}else if($tgian == '30'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
}else if($tgian == '180'){
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(180)->toDateString();
}else{
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
}
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$sql = $db->query("SELECT * FROM `statist` WHERE `o_date` BETWEEN '$subdays' AND '$now' ORDER BY `o_date` ASC");
while ($row = $sql->fetch()) {
    $chart_data[]= array(
        'date' => $row['o_date'],
        'order' => $row['sl_o'],
        'revenue' => $row['stt'],
        'quantity' => $row['sl_p'],
    );
    
}
echo $data = json_encode($chart_data);
?>