<?php
require_once "include/session.php";
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
?>
<?php
require_once "include/header.php";
?>

            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <form method="POST">
                <?php 
            require_once "functions/database.php"; 
            require_once "functions/user.php"; 
        ?>


                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="assets/img/user.jpg" alt="user">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" name="picture" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">


                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Title</label>
                                                <input type="text" name="title" class="form-control floating" value="<?php echo $user ['title'] ?>">
                                            </div>
                                        </div>

                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" name="firstname" class="form-control floating" value="<?php echo $user ['first_name']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" name="lastname" class="form-control floating" value="<?php echo $user ['last_name']?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Email</label>
                                                <input type="email" name="email" class="form-control floating" value="<?php echo $user ['email']?>">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" name="address" class="form-control floating" value="">
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone Number</label>
                                    <input type="text" name="phonenumber" class="form-control floating" value=""> 
                                </div>
                            </div>
                        </div>
                    </div>

<?php require_once "include/isset.php"; ?>
                    <div class="text-center m-t-20">
                        <input class="btn btn-primary submit-btn" type="submit" name="save" type="button" value="save">
                    </div>
                </form>
            </div>
            <?php require_once "include/body.php"; ?>
        <?php 
        require_once "include/footer.php";
        ?>