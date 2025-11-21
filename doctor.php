<?php 
	require_once "include/header.php"; 
	require_once "functions/doctors.php";
	$doctor = new Doctors();
	$doctors = $doctor->getDoctors();
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_doctor.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
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
										<th>specialization</th>
										<th> Department</th>
										<th>Email</th>
										<th>Phone</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($doctors as $doctor){ ?>
									<tr>
										<td><?= $doctor['doctor_id'] ?></td>
										<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?= $doctor ['name'] ?></td>
										<td><?= $doctor['specialization'] ?></td>
										<td><?= $doctor['department_id'] ?></td>
										<td><?= $doctor['email'] ?></td>
										<td><?= $doctor['phone']; ?></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="edit_doctor.php?doctor_id=<?php echo $doctor ['doctor_id']?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item"   href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
						<h3>Are you sure want to delete this Doctor?</h3>
						<?php require_once "include/isset.php"; ?>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" name="delete" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
  

<?php require_once "include/footer.php"; ?>