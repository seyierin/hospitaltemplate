<?php
require_once "include/session.php";
require_once "include/header.php";
require_once "functions/patients.php";
$Patient = new patients();
if(isset($_GET['patient_id']) && $_GET['patient_id'] != ""){
	$patient = $Patient->getPatient(htmlspecialchars($_GET['patient_id']));
}
if(!$patient){
    echo "<script>window.location.href='patients.php';</script>";
    exit;
}
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

          
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Patient</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                        <?php 
            require_once "functions/database.php"; 
            require_once "functions/edit_patient.php"; 
        ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input name="first_name" class="form-control" value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" class="form-control" value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>" type="text">
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" class="form-control" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" type="email">
                                    </div>
                                </div>
                               
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input name="dob" type="date" value="<?php if(isset($_POST['date'])) { echo $_POST['date']; } ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" class="form-check-input">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" class="form-check-input">Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input name="address" type="text" value="<?php if(isset($_POST['address'])) { echo $_POST['address']; } ?>" class="form-control ">
											</div>
										</div>
										
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input name="contact" class="form-control" value="<?php if(isset($_POST['contact'])) { echo $_POST['contact']; } ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Emergency Contact </label>
                                        <input name="emergency_contact" class="form-control" value="<?php if(isset($_POST['emergency_contact'])) { echo $_POST['emergency_contact']; } ?>" type="text">
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
                                <button class="btn btn-primary submit-btn" name="edit_patient" type="submit">Edit Patient</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<?php require_once "include/body.php"; ?>
<?php require_once "include/footer.php"; ?>