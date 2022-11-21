<?php
require_once "head.php";
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
require_once "end.php";
?>