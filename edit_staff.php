<?php
require_once "include/session.php";
require_once "include/header.php";
require_once "functions/staff.php";
$Staff = new staff();
if(isset($_GET['staff_id']) && $_GET['staff_id'] != ""){
    $member = $Staff->getStaff(htmlspecialchars($_GET['staff_id']));
    $departments = $database->select("departments", method: "all");
    $Roles = $roles->get_role();
}
if(!$member){
    echo "<script>window.location.href='staff.php';</script>";
    exit;
}
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Staff</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input name="name" class="form-control" value="<?= $_POST['name'] ?? $member['name'] ?>" type="text">
                                    </div>
                                </div>
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" name="role">
                                            <option value="">Select Role</option>
                                            <?php foreach($Roles as $role){ ?>
                                                <option value="<?= $role['ID'] ?>" <?php if(($_POST['role'] ?? $member['role']) == $role['ID']) echo "selected"; ?>> <?= $role['name'] ?></option>
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
                                                <option value="<?= $department['department_id'] ?>" <?php if(($_POST['department'] ?? $member['department_id']) == $department['department_id']) echo "selected"; ?>><?= $department['department_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" class="form-control" value="<?= $_POST['email'] ?? $member['email'] ?>" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input name="contact" class="form-control" value="<?= $_POST['contact'] ?? $member['phone'] ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input name="salary" class="form-control" value="<?= $_POST['salary'] ?? $member['salary'] ?>" type="number" step="0.01">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="display-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="staff_active" value="active" <?php if(($_POST['status'] ?? $member['status']) == 'active') echo 'checked'; ?>>
                                            <label class="form-check-label" for="staff_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="staff_inactive" value="inactive" <?php if(($_POST['status'] ?? $member['status']) == 'inactive') echo 'checked'; ?>>
                                            <label class="form-check-label" for="staff_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php require_once "include/isset.php";  ?>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="edit_staff" type="submit">Edit Staff</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once "include/body.php"; ?>
<?php require_once "include/footer.php"; ?>