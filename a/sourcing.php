<?php require_once 'view/head.php';
require_once 'view/sidebar.php'; ?>

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="container">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Start Sourcing | <a href="addSourcing.php">ADD</a></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button> -->
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 10%">
                          Name
                      </th>
                      <th style="width: 10%">
                          Start day
                      </th>
                      <th style="width: 35%">
                          End day
                      </th>
					  <th style="width: 15%">
                          Number of product
                      </th>
					  <th style="width: 5%">&nbsp;
                      </th>
                     
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $gbs = $db->query("SELECT * FROM `gb` ORDER BY `g_id` DESC");
                  foreach ($gbs as $gb) {
				  	$g_id = $gb['g_id'];
            $s_day = date("d-m-Y", $gb['s_date']); 
            $e_day = date("d-m-Y", $gb['e_date']); 
				  ?>
                      <tr>
                          <td>
                              <?= $gb['g_id']; ?>
                          </td>
                          <td>
                                <?= $gb['g_name'] ?>
                          </td>
                          <td>
                                <?= $s_day ?>
                          </td>
                          <td>
                                <?= $e_day?>
                          </td>
						  <td>
                                <?php 
								  $ssp = $db->query("SELECT COUNT(p_id) AS count FROM `gb_list` WHERE `g_id` = '$g_id';");	
								  foreach ($ssp as $l) {
									  echo $l['count'];
								  }
					  			?>
                          </td>

						  <td class="project-actions text-right">
							 <a class="btn btn-primary btn-sm" href="addList.php?g_id=<?=$gb['g_id']; ?>">
								UPDATE 
							</a>
                     	  </td>
                      </tr>
                <?php } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'view/end.php'; ?>