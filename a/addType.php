<?php require_once 'view/head.php';
require_once 'view/sidebar.php';
?>
<?php
    if(isset($_POST['save'])){
        $cate=$_POST['cate'];
        $type = $_POST['type'];

        $db->query("INSERT INTO `type` (`cate`, `type`) VALUES ('$cate', '$type')");
        if($type == ''){
            echo '<script>alert("Đã thêm danh mục ' . $cate . '"); window.location = "cate_type.php";</script>';
        }else{
            echo '<script>alert("Đã thêm nhãn hàng '.$type. ' vào danh mục ' . $cate . '"); window.location = "cate_type.php";</script>';
        }
    }

?>

<div class="container">
    <form method="POST" action="">
        <input type="radio" id="addtype" name="subject" value="" class="addType" checked>
            <label for="">Add type</label> 
        <div class="col-8 d-flex align-items-center">
            <select class="form-select" name="cate" style="width: 20%; height:100%; margin-right: 5px" aria-label="Default select example">
                <?php
                $cates = $db->query("SELECT * FROM `type` WHERE `type` = '' ORDER BY `t_id` ASC");
                foreach ($cates as $cate) {
                ?>
                    <option value="<?= $cate['cate'] ?>"><?= $cate['cate'] ?></option>
                <?php } ?>
            </select>
            <div class="" style="width: 80%; height:100%;">
                <input  type="text" id ="type" class="form-control" name="type"  placeholder="Enter type name" required>
            </div>
        </div>

        <div class="">
            <input type="radio" id="other" name="subject" value="" class="addCate">
            <label for="">Add category</label>
            
        </div>
        <div class="col-8">
            <div class="form-group" style="width: 100%; height:100%;">
                <input type="text" id="otherlang" class="form-control" name="cate" disabled="disabled" placeholder="Enter category name" required>
            </div>
        </div>
                        <div class="mt-1">
                    <button type="submit" name="save" class="btn btn-success">ADD</button>
                </div>
    </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $("input[name='subject']").click(function() {
        $("#otherlang").prop("disabled", true);
        $('#otherlang').val("");
        if ($(this).hasClass('addCate')) {
            $("#otherlang").prop("disabled", false);
        }
    });

    $("input[name='subject']").click(function() {
        $("#type").prop("readonly", true);
        $('#type').val("");
        if ($(this).hasClass('addType')) {
            $("#type").prop("readonly", false);
        }
    });
</script>
<gwmw style="display:none;">
    <gwmw style="display:none;"></gwmw>
</gwmw>
</div>
<?php require_once 'view/end.php'; ?>