<?php 
	require_once "include/header.php"; 
	require_once "functions/staff.php";
	$Staff = new staff();
	$staffs = $Staff->getStaffs();
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Staff</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_staff.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Staff</a>
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
										<th>Role</th>
										<th>Department</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Salary</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($staffs as $member){ ?>
									<tr>
										<td><?= $member['staff_id'] ?></td>
										<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?= $member['name'] ?></td>
										<td><?= $member['role'] ?></td>
										<td><?= $member['department_id'] ?></td>
										<td><?= $member['email'] ?></td>
										<td><?= $member['phone']; ?></td>
										<td><?= $member['salary']; ?></td>
										<td><?= $member['status']; ?></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="edit_staff.php?staff_id=<?= $member['staff_id'] ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item"   href="#" data-toggle="modal" data-target="#delete_staff" data-id="<?= $member['staff_id'] ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
        <div id="delete_staff" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Staff?</h3>
						<form method="POST">
                            <?php require_once "include/isset.php"; ?>
                            <input type="hidden" name="staff_id" id="delete_staff_id" value="">
							<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
								<button type="submit" name="delete_staff" class="btn btn-danger">Delete</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
        </div>
  

<?php require_once "include/footer.php"; ?>
<script>
document.addEventListener('click', function(e){
    var t = e.target.closest('[data-target="#delete_staff"]');
    if(t && t.dataset && t.dataset.id){
        var input = document.getElementById('delete_staff_id');
        if(input) input.value = t.dataset.id;
    }
});
</script>