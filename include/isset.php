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

    if(isset($_POST['edit_patient'])) {
        // call change password function
        $editpatient = new editpatient();
        $editpatient->updatepatient(htmlspecialchars($patients['patient_id']));
        // print_r($_POST);
    }

    if(isset($_POST['add_doctor'])) {
        // call change password function
        $doctor = new Doctors();
        $doctor->addDoctor();
        // print_r($_POST);
    }

    if(isset($_POST['delete'])) {
        // call change password function
        $remove = new patients();
        $remove->deletePatient();
        // print_r($_POST);
    }

    if(isset($_POST['edit_doctor'])) {
        // call change password function
        $editdoctor = new editdoctor();
        $editdoctor->UpdateDoctor(htmlspecialchars($doctors['doctor_id']));
        // print_r($_POST);
    }

    if(isset($_POST['delete'])) {
        // call change password function
        $deletedoctor = new Doctors();
        $deletedoctor->deleteDoctor(htmlspecialchars($doctors['doctor_id']));
        // print_r($_POST);
    }