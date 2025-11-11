<?php 
    if(isset($_POST['register'])) {
        // call register function
        $auth = new Auth();
        $auth->registerUser();
        // print_r($_POST);
    }

    if(isset($_POST['login'])) {
        // call login function
        $auth = new Auth();
        $auth->signin();
        // print_r($_POST);
    }

    if(isset($_POST['save'])) {
        // call edit profile function
        $userObj = new user();
        $userObj->updateUser(htmlspecialchars($_SESSION['ID']));
        // print_r($_POST);
    }

    if(isset($_POST['add_patient'])) {
        // call change password function
        $patient = new patients();
        $patient->addPatient();
        // print_r($_POST);
    }