<?php 
	require_once "include/header.php"; 
	require_once "functions/patients.php";
	$patient = new patients();
	$patients = $patient->getPatients();
?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
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
										<th>Email</th>
										<th>DOB</th>
										<th>Gender</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Emergency Contact</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($patients as $patient){ ?>
									<tr>
										<td><?= $patient['patient_id'] ?></td>
										<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?= ucwords($patient['first_name'].' '.$patient['last_name']) ?></td>
										<td><?= $patient['email'] ?></td>
										<td><?= $patient['dob'] ?></td>
										<td><?= $patient['gender'] ?></td>
										<td><?= $patient['address']; ?></td>
										<td><?= $patient['contact']; ?></td>
										<td><?= $patient['emergency_contact']; ?></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="edit_patient.php?patient_id=<?= $patient['patient_id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" name="delete" href="#" type="submit"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
  

<?php require_once "include/footer.php"; ?>