<?php require_once 'view/head.php';
require_once 'view/sidebar.php';
?>
<?php
    if (isset($_POST['save'])) {
        $g_name = mpost('g_name');
        $s_day = mpost('s_day');
        $s_date = DateTime::createFromFormat('d-m-Y', $s_day)-> getTimestamp();
        $e_day = mpost('e_day');
        $e_date = DateTime::createFromFormat('d-m-Y', $e_day)-> getTimestamp();

        // echo $s_day."-" .$e_day ;
        // echo "CONVERT = " ;
        // echo $s_date."-" .$e_date;

        $db->exec("INSERT INTO `gb`  (`g_name`,`s_date`,`e_date`,`gb_stt`) VALUES ( '$g_name','$s_date','$e_date','Đang mở group buy');");
        echo '<script>alert("Đã thêm đợt ' . $g_name . '"); window.location = "sourcing.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->

      <div class="container">
            <h1>Add New Start Sourcing</h1>
        </div>


    <!-- Main content -->
 <div class="container">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-8">
                  	<div class="form-group">
    					<input name="g_name" type="text" class="form-control" placeholder="" required>
  					</div>
                </div>
              </div>
				
              <div class="form-group d-flex align-items-center">
                <label class="col-sm-1">Open date:</label>
                <div class="col-sm-5">
                  	<div class="form-group">
                      <input type="text" name = "s_day" id="date_picker1" class="form-control">
  					</div>
                </div>
                <label class="col-sm-1">Close date: </label>
                <div class="col-sm-5">
                  	<div class="form-group">
                      <input type="text" name = "e_day" id="date_picker2" class="form-control">
                        
  					</div>
                </div>
              </div>
			
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-success">ADD</button>
                </div>
            </div>
            </form>
                  </div>
    </div>

</div>



<?php require_once 'view/end.php'; ?>

<script>
$(document).ready(function() {
///////
var startDate;
var endDate;
 $( "#date_picker1" ).datepicker({
dateFormat: 'dd-mm-yy'
})
///////
///////
 $( "#date_picker2" ).datepicker({
dateFormat: 'dd-mm-yy'
});
///////
$('#date_picker1').change(function() {
startDate = $(this).datepicker('getDate');
$("#date_picker2").datepicker("option", "minDate", startDate );
})

///////
$('#date_picker2').change(function() {
endDate = $(this).datepicker('getDate');
$("#date_picker1").datepicker("option", "maxDate", endDate );
})
})
</script>