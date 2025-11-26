<?php require_once "include/header.php";
 require_once "functions/staff.php";
 $departments = $database->select("departments", method: "all");
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 $Roles = $roles->get_role();
?>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Staff</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input name="name" class="form-control" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" type="text">
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
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="">Select Role</option>
                                            <?php foreach($Roles as $role){ ?>
                                                <option value="<?= $role['ID'] ?>" > <?= $role['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" name="department">
                                            <option value="">Select Department</option>
                                            <?php foreach($departments as $department){ ?>
                                                <option value="<?= $department['department_id'] ?>" > <?= $department['department_name'] ?></option>
                                            <?php } ?>
                                        </select>
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
                                        <label>Salary</label>
                                        <input name="salary" class="form-control" value="<?php if(isset($_POST['salary'])) { echo $_POST['salary']; } ?>" type="number" step="0.01">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="display-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="staff_active" value="active" <?php if(($_POST['status'] ?? 'active') == 'active') echo 'checked'; ?>>
                                            <label class="form-check-label" for="staff_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="staff_inactive" value="inactive" <?php if(($_POST['status'] ?? '') == 'inactive') echo 'checked'; ?>>
                                            <label class="form-check-label" for="staff_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php require_once "include/isset.php";  ?>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="add_staff" type="submit">Create Staff</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once "include/body.php"; ?>
<?php require_once "include/footer.php"; ?>