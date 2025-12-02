<?php 
	require_once "include/header.php"; 
	require_once "functions/roles.php";
	$role = new roles();
	$roles = $role->get_role();
?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Roles</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="manage_role.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Role</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Date Created</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($roles as $role){ ?>
									<tr>
										<td><?= $role['ID'] ?></td>
										<td><?= $role['name'] ?></td>
										<td><?= $role['date'] ?></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="manage_role.php?ID=<?= $role['ID'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item"  href="#"  data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
<?php require_once "include/body.php"; ?>
		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						<?php require_once "include/isset.php"; ?>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button name="delete" type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
  

<?php require_once "include/footer.php"; ?>