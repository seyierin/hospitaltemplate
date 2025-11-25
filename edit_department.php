<?php
require_once "include/session.php";
require_once "include/header.php";
require_once "functions/department.php";
$Department = new Department();
if(isset($_GET['department_id']) && $_GET['department_id'] != ""){
	$department = $Department->getDepartment(htmlspecialchars($_GET['department_id']));
   // $departments = $database->select("departments", method: "all");
}
if(!$department){
    echo "<script>window.location.href='departments.php';</script>";
    exit;
}

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

          
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Department</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                        <?php 
            require_once "functions/database.php"; 
        ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input name="name" class="form-control" value="<?= $_POST['name'] ?? $department ['department_name'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input name="description" class="form-control" value="<?= $_POST['description'] ?? $department ['description']  ?>" type="text">
                                    </div>
                                </div>

                                <!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" class="form-control">
											</div>
										</div>
									</div>
                                </div> -->
                            </div>
                            <!-- <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_active" value="option1" checked>
									<label class="form-check-label" for="patient_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="option2">
									<label class="form-check-label" for="patient_inactive">
									Inactive
									</label>
								</div>
                            </div> -->
                            <?php require_once "include/isset.php";  ?>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="edit_department" type="submit">Edit Department</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php require_once "include/body.php"; ?>
<?php require_once "include/footer.php"; ?>