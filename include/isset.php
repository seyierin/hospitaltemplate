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
        $editpatient = new patients();
        $editpatient->updatepatient(htmlspecialchars($patient['patient_id']));
        // print_r($_POST);
    }

    if(isset($_POST['add_doctor'])) {
        // call change password function
        $doctor = new Doctors();
        $doctor->addDoctor();
        // print_r($_POST);
    }


    if(isset($_POST['add_department'])) {
        // call change password function
        $department = new Department();
        $department->addDepartment();
        // print_r($_POST);
    }

    if(isset($_POST['delete'])) {
        // call change password function
        $remove = new patients();
        $remove->deletePatient(htmlspecialchars($patient['patient_id']));
        // print_r($_POST);
    }

    if(isset($_POST['edit_doctor'])) {
        // call change password function
        $editdoctor = new Doctors();
        $editdoctor->UpdateDoctor(htmlspecialchars($doctor['doctor_id']));
        // print_r($_POST);
    }


    if(isset($_POST['edit_department'])) {
        // call change password function
        $editdoctor = new Department();
        $editdoctor->UpdateDepartment(htmlspecialchars($department['department_id']));
        // print_r($_POST);
    }

    if(isset($_POST['delete'])) {
        // call change password function
        $deletedoctor = new Doctors();
        $deletedoctor->deleteDoctor(htmlspecialchars($doctor['doctor_id']));
        // print_r($_POST);
    }

    if(isset($_POST['add_staff'])) {
        $staffObj = new staff();
        $staffObj->addStaff();
    }

    if(isset($_POST['edit_staff'])) {
        $staffObj = new staff();
        $staffID = htmlspecialchars($_GET['staff_id'] ?? $_POST['staff_id'] ?? "");
        if($staffID != "") $staffObj->updateStaff($staffID);
    }

    if(isset($_POST['delete_staff'])) {
        $staffObj = new staff();
        $staffID = htmlspecialchars($_POST['staff_id'] ?? $_GET['staff_id'] ?? "");
        if($staffID != "") $staffObj->deleteStaff($staffID);
    }