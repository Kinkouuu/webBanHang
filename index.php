<?php
require_once("template/header.php");
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 p-0">
			<?php
			require_once("template/nav.php");
			require_once("menu.php");
			?>
			<?php 
				$temp = $_GET['action'];
				if ($temp == "intro"){
					$img = "img/intro.jpg";
				}
				else if ($temp == "whole") {
					$img = "img/startsourcing.jpg";
				}
				else if ($temp == ""){
					$img = "img/banner.jpg";
				}
				else {
					$img = "img/product.jpg";
				}
			?>
					<div class="banner" style ="width:100%;height:auto">
						<img src="<?= $img; ?>" class="d-block w-100" alt="...">
					</div>
			<?php ?>
			<div class="main-content mt-2 ms-5 me-5">
				<?php
				if (isset($_GET['action'])) {
					$tam = $_GET['action'];
				} else {
					$tam = '';
				}
				if ($tam == 'kit') {
					require_once("main/kit.php");
				} elseif ($tam == 'keycap') {
					require_once("main/keycap.php");
				} elseif ($tam == 'switch') {
					require_once("main/switch.php");
				}elseif ($tam == 'whole') {
						require_once("main/whole.php");
				}elseif ($tam == 'intro') {
						require_once("main/intro.php");
				} else {
					require_once("main/home.php");
				}
				?>
			</div>

		</div>
	</div>
</div>
<?php
require_once("template/footer.php");
?>