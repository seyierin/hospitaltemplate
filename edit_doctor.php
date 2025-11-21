<?php
require_once "include/session.php";
require_once "include/header.php";
require_once "functions/doctors.php";
$Doctor = new Doctors();
if(isset($_GET['doctor_id']) && $_GET['doctor_id'] != ""){
	$doctor = $Doctor->getDoctor(htmlspecialchars($_GET['doctor_id']));
    $departments = $database->select("departments", method: "all");
}
if(!$doctor){
    echo "<script>window.location.href='doctor.php';</script>";
    exit;
}

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

          
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                        <?php 
            require_once "functions/database.php"; 
            require_once "functions/edit_doctor.php"; 
        ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input name="name" class="form-control" value="<?= $_POST['name'] ?? $doctor ['name'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Specialization</label>
                                        <input name="specialty" class="form-control" value="<?= $_POST['specialty'] ?? $doctor ['specialization']  ?>" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" name="department">
                                            <option value="">Select Department</option>
                                            <?php foreach($departments as $department){ ?>
                                                <option value="<?= $department['department_id'] ?>" <?php if(($_POST['department'] ?? $doctor['department_id']) == $department['department_id']) echo "selected"; ?>><?= $department['department_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" class="form-control" value="<?= $_POST['email'] ?? $doctor ['email']  ?>" type="email">
                                    </div>
                                </div>
                               
						
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input name="contact" class="form-control" value="<?= $_POST['contact'] ?? $doctor ['phone'] ?>" type="text">
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
                                <button class="btn btn-primary submit-btn" name="edit_doctor" type="submit">Edit Doctor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php require_once "include/body.php"; ?>
<?php require_once "include/footer.php"; ?>