<?php require_once 'view/head.php'; ?>

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>

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
                          Phone
                      </th>
                      <th style="width: 35%">
                          Address
                      </th>
					  <th style="width: 15%">
                          Number of Orders
                      </th>
					  <th style="width: 25%">
                          Comment
                      </th>
					  <th style="width: 5%">&nbsp;
                      </th>
                     
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $users = $db->query("SELECT * FROM `user` ORDER BY `u_id` DESC");
                  foreach ($users as $user) {
				  	$id = $user['u_id'];
				  ?>
                      <tr>
                          <td>
                              <?= $user['u_id']; ?>
                          </td>
                          <td>
                                <?= $user['f_name'] . " " . $user['l_name']; ?>
                          </td>
                          <td>
                                <?= $user['phone']; ?>
                          </td>
                          <td>
                                <?= $user['city'] . ", " . $user['district'] . ", " . $user['ward'] . ", " . $user['street'] . ", " . $user['no']; ?>
                          </td>
						  <td>
                                <?php 
								  $a = $db->query("SELECT COUNT(u_id) AS count FROM `order` WHERE `u_id` = '$id';");	
								  foreach ($a as $A) {
									  echo $A['count'];
								  }
					  			?>
                          </td>
						  <td>
                                <?= $user['comment']; ?>
                          </td>
						  <td class="project-actions text-right">
							 <a class="btn btn-primary btn-sm" href="commentUser.php?u_id=<?=$user['u_id']; ?>">
               ✒
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