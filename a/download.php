<?php
require_once "../template/core.php";
$dbhost = 'a2nlmysql7plsk.secureserver.net:3306';
$dbname = 'shop';
$dbusername = 'shop';
$dbpassword = 'Hai@qt123';

// Connect to MySQL Database
$con = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<?php
if (isset($_POST["export"])){
	$query = "SELECT * FROM `final` ORDER BY `oid` ASC";
	if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));		
	}
	$data = array();
	if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_assoc($result)) {
        	$data[] = $row;
    	}
	}
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=ordered.csv');
	$output = fopen('php://output', 'w');
	fputcsv($output, array('ID', 'NAME', 'PHONE', 'DELIVERY DATE', 'PRODUCT CATEGORY', 'PRODUCT TYPE', 'PRODUCT ID', 'PRODUCT NAME','PRODUCT SOLD', 'PRODUCT PRICE', 'REMAIN', 'DELIVERY FEE', 'DISCOUNT', 'ADDRESS', 'DISTRICT', 'CITY', 'TOTAL COST'));
	if (count($data) > 0) {
    	foreach ($data as $row) {
        	fputcsv($output, $row);
    	}
	}
}

$db->query("DELETE FROM `final`");
?>