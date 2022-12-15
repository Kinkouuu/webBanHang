<?php
require_once "view/head.php";
// require_once "thongke.php";
?>
<body>
<div class="d-flex">
<h1>Revenue statistics: </h1><h1 id ="text-date"></h1>
</div>
<select class="select-date" aria-label="Default select example">
  <option value="7">A week</option>
  <option value="30">A month</option>
  <option value="180">Half a year</option>
  <option value="365">A year</option>
</select>
<div id="chart" style="height: 500px;"></div>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-6">
      <?php
    $total = $db->query("SELECT count(distinct `order`.o_id) as sdh, sum(`details`.amount) as ssp,sum(`details`.amount*`details`.d_price) as st FROM `order`,`details` WHERE `order`.o_id = `details`.o_id")->fetch();
    $fee = $db->query("SELECT DISTINCT `ID` FROM `order` WHERE `ID`!= 0 ")->rowCount(); 
      ?>
      <h3>Total basket order: <?php echo $fee. '=' .$fee*35000 .' VND'   ?></h3>
      <h3>Total orders: <?php echo $total['sdh']?> orders</h3>
      <h3>Total products sold: <?php echo $total['ssp']?> products</h3>
      <h3>Total revenue: <?php echo number_format($total['st']+ 35000*$total['sdh']) ?> VND</h3>
    </div>
    <div class="col-md-6">
    <?php
$gmv = $db->query("SELECT sum(stt) as stt, sum(sl_o) as sl_o, sum(sl_p) as sl_p  FROM `statist`")->fetch();
?>
  <h3>Completed orders: <?php echo $gmv['sl_o']?> orders</h3>
  <h3>Actual products sold: <?php echo $gmv['sl_p']?> products</h3>
  <h3>Actual revenue: <?php echo number_format($gmv['stt'])?> VND</h3>
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    thongke();
    var char = new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'chart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  xkey: 'date',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['order', 'revenue','quantity'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Đơn hàng','Doanh thu','Số sản phẩm']
});
// chon ngay
$('.select-date').change (function (){
  var tgian = $(this).val();
  if(tgian == '7'){
    var text = "7 days ago";
  }else if(tgian == '30'){
    var text = "30 days ago";
  }else if(tgian == '180') {
    var text = "180 days ago";
  }else{
    var text = "365 days ago";
  }
  $.ajax({
    url:"thongke.php",
    method: "POST",
    dataType: "JSON",
    data:{tgian:tgian},
    success:function(data){
      char.setData(data);
      $('#text-date').text(text);
    }
  })
});
// in thong ke
function thongke(){
  var text = "7 days ago";
  $.ajax({
    url:"thongke.php",
    method: "POST",
    dataType: "JSON",
    success:function(data){
      char.setData(data);
      $('#text-date').text(text);
    }
  })

  }
});
</script>

</div>
<?php
require_once "view/end.php";
?>